// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;
// set pragma solidity between 0.5.0 and 0.7.0

contract ganache {

    string message = '';
    uint [] list;

    function setMessage(string memory _message) public {
        message = _message;
    }

    // Visualizar el mensaje de la cadena de bloques
    function getMessage() public view returns (string memory) {
        return message;
    }
}
