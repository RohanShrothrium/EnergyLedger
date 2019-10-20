# GreenLedger
_Energy management tool to track carbon footprint_
![GreenLedger Logo](https://raw.githubusercontent.com/RohanShrothrium/EnergyLedger/hacktober/Logo/logo.jpg)

## Steps to run the project
1. Install Hyperledger Fabric
2. Clone this repo into your PC's PHP executable path (which is _/var/www/html/_ by default)
3. **Rename the main folder, GreenLedger, to EnergyLedger (as all our hyperlinks are configured to EnergyLedger and not GreenLedger)**.
4. Goto http://localhost/EnergyLedger to find the login page.

## To create a user
Invoke transactions to create a user of choice in the consortium
`cd node_sdk/; node invoke.js CreateUser <UserID> <Username> <Password>; cd ../`

Kindly use the name value for UserID and Username and use the value `user` for password.

## To login
1. Use the User accountwhich was created.
2. If the user is a Producer or a consumer, kindly enter the password as 'user' and if the user is a regulatory body, kindly use the password 'produce'.

## Usage as a Producer
1. The producer's role is to produce electricity, send it to the regulatory body and request a GO (Guarantee of Origin) token each commercial sent. The granted tokens can then be transferred to the regulatory body (or) a consumer, depending on the rules of the country.
2. Once the producer's tokens are granted, the GO token is unique and will bear details of each owner of the commercial unit associated with the GO token.

## Usage as a Regulatory Body
1. Whichever Producer requested for the token (green or red), can be granted those tokens by the regulatory body after a simple (as of now) anomaly check which rejects more than 5 or less than 2 tokens (as they are outliers and it seems unnatural for the producers to produce such energy). The anomaly check is implemented just as a notion of security, though it doesn't serve much purpose as of now.

## Usage as a Consumer
1. Consumers can strike a deal in real life and get their units and GO tokens transferred to them over the chain.
