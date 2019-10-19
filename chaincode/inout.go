package main

import (
	"encoding/json"
	"fmt"
	"github.com/hyperledger/fabric/core/chaincode/shim"
	pb "github.com/hyperledger/fabric/protos/peer"
	"crypto/sha256"
	"math/rand"
	"strconv"
)
var (
	fileName = "inout"
)

//structure of chaincode
type InOutChaincode struct{
}

// GO token structure
type GO struct{
	UserID string `json:"UserID"`
	Origin string `json:"Origin"`
	Date string `json:"Date"`
}

// User Structure
type User struct{
	Username string `json:"Username"`
	PasswordHash [32]byte `json:"PasswordHash"`
	GoListGreen []string `json:"GoListGreen"`
	GoListRed []string `json:"GoListRed"`
}


//initialization function
func (t *InOutChaincode) Init(stub shim.ChaincodeStubInterface)pb.Response{
	// Whatever variable initialisation you want can be done here //
	return shim.Success(nil)
}

// invoking functions
func  (t *InOutChaincode) Invoke(stub shim.ChaincodeStubInterface)pb.Response{
	// IF-ELSE-IF all the functions 
	function, args := stub.GetFunctionAndParameters()
	if function == "CreateUser" {
		return t.CreateUser(stub, args)
	}else if function == "Mint" {
		return t.Mint(stub, args)
	}else if function == "ChangeOwnership"{
		return t.ChangeOwnership(stub, args)
	}else if function == "Query"{
		return t.Query(stub, args)
	}
	fmt.Println("invoke did not find func : " + function) //error
	return shim.Error("Received unknown function invocation")
	// end of all functions
}

// User Verify Password
func UserVerifyPassword(stub shim.ChaincodeStubInterface, UserID string, Password string) int {
	UserAsBytes, err := stub.GetState(UserID)
	if err != nil {
		return 0
	}else if UserAsBytes == nil{
		return 0
	}
	var User User
	err = json.Unmarshal(UserAsBytes, &User)
	if err != nil {
		return 0
	}
	if User.PasswordHash == sha256.Sum256([]byte(Password)) {
        return 1
    }
	return 0
}

// Adding info about a user
func  (t *InOutChaincode) CreateUser(stub shim.ChaincodeStubInterface, args []string)pb.Response{
	var UserID = args[0]
	var Username = args[1]
	var Password = args[2]
	PasswordHash := sha256.Sum256([]byte(Password))
	// checking for an error or if the user already exists
	UserAsBytes, err := stub.GetState(UserID)
	if err != nil {
		return shim.Error("Failed to get Username:" + err.Error())
	}else if UserAsBytes != nil{
		return shim.Error("User with current username already exists")
	}

	var User = &User{Username:Username, PasswordHash:PasswordHash,}
	UserJsonAsBytes, err :=json.Marshal(User)
	if err != nil {
		shim.Error("Error encountered while Marshalling")
	}
	err = stub.PutState(UserID, UserJsonAsBytes)
	if err != nil {
		shim.Error("Error encountered while Creating User")
	}
	fmt.Println("Ledger Updated Successfully")
	return shim.Success(nil)
}

// Minting a Token
func  (t *InOutChaincode) Mint(stub shim.ChaincodeStubInterface, args []string)pb.Response{
	var UserID = args[0]
	var isGreen = args[1]
	var Date = args[2]
	Hash :=  strconv.Itoa(rand.Int())
	UserAsBytes, err := stub.GetState(UserID)
	var User User
	err = json.Unmarshal(UserAsBytes, &User)
	if err != nil {
		return shim.Error("Error encountered during unmarshalling the data")
	}
	if isGreen == "1" {
		User.GoListGreen = append(User.GoListGreen, Hash)
	}else {
		User.GoListRed = append(User.GoListRed, Hash)
	}
	UserJsonAsBytes, err := json.Marshal(User)
	stub.PutState(UserID, UserJsonAsBytes)
	TokenAsBytes, err := stub.GetState(Hash)
	if err != nil {
		return shim.Error("Failed to get Mint:" + err.Error())
	}else if TokenAsBytes != nil{
		return shim.Error("GO token has already been minted")
	}

	var GO = &GO{UserID:UserID, Origin:isGreen, Date:Date}
	TokenJsonAsBytes, err := json.Marshal(GO)
	if err != nil {
		shim.Error("Error encountered while Marshalling")
	}
	err = stub.PutState(Hash, TokenJsonAsBytes)
	if err != nil {
		shim.Error("Error encountered while Minting Token")
	}
	fmt.Println("Ledger Updated Successfully")
	return shim.Success(nil)
}

// Query Function
func  (t *InOutChaincode) Query(stub shim.ChaincodeStubInterface, args []string)pb.Response{
	DataAsBytes, err := stub.GetState(args[0])
	if err != nil {
		return shim.Error("Error encountered")
	}else if DataAsBytes == nil {
		return shim.Error("No Data")
	}
	return shim.Success(DataAsBytes)
}

// // Change Ownership
func  (t *InOutChaincode) ChangeOwnership(stub shim.ChaincodeStubInterface, args []string)pb.Response{
	var UserID = args[0]
	var Password = args[1]
	if UserVerifyPassword(stub, UserID, Password) == 0{
		return shim.Error("Password doesn't match Organisation")
	}
	UserAsBytes, err := stub.GetState(UserID)
	var User1 User
	err = json.Unmarshal(UserAsBytes, &User1)
	if err != nil {
		return shim.Error("Error encountered during unmarshalling the data")
	}
	var DestUserID = args[2]
	User2AsBytes, err := stub.GetState(DestUserID)
	var User2 User
	err = json.Unmarshal(User2AsBytes, &User2)
	if err != nil {
		return shim.Error("Error encountered during unmarshalling the data")
	}
	var isGreen = args[3]
	var numberStr = args[4]
	number, err := strconv.Atoi(numberStr)
	if isGreen == "1" {
		for i, b := range User1.GoListGreen{
			if b != "0" && number > 0 {
				number = number - 1
				TokenAsBytes, err := stub.GetState(b)
				var GO GO
				err = json.Unmarshal(TokenAsBytes, &GO)
				if err != nil {
					return shim.Error("Error encountered during unmarshalling the data")
				}
				User2.GoListGreen = append(User2.GoListGreen, b)
				GO.UserID = DestUserID
				TokenJsonAsBytes, err := json.Marshal(GO)
				stub.PutState(b, TokenJsonAsBytes)
				User1.GoListGreen[i] = "0"
			}
		}
	}else {
		for i, b := range User1.GoListRed{
			if b != "0" && number > 0 {
				number = number - 1
				TokenAsBytes, err := stub.GetState(b)
				var GO GO
				err = json.Unmarshal(TokenAsBytes, &GO)
				if err != nil {
					return shim.Error("Error encountered during unmarshalling the data")
				}
				User2.GoListRed = append(User2.GoListRed, b)
				GO.UserID = DestUserID
				TokenJsonAsBytes, err := json.Marshal(GO)
				stub.PutState(b, TokenJsonAsBytes)
				User1.GoListRed[i] = "0"
			}
		}
	}
	UserJsonAsBytes, err := json.Marshal(User1)
	stub.PutState(UserID, UserJsonAsBytes)
	User2JsonAsBytes, err := json.Marshal(User2)
	stub.PutState(DestUserID, User2JsonAsBytes)
	fmt.Println("Ledger Updated Successfully")
	return shim.Success(nil)
}

// MAIN FUNCTION
func  main() {
	err := shim.Start(new(InOutChaincode))
	if err != nil {
		fmt.Printf("Error starting Chaincode: %s", err)
	}
}