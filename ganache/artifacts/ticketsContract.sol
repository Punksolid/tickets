// SPDX-License-Identifier: MIT

pragma solidity ^0.8.0;

contract ticketsContract {
    struct Ticket {
        uint256 folio;
        string incident;
        string department;
        string incident_address;
    }

    mapping(uint256 => Ticket) ticketsMap;

    function addTicket(uint256 _folio, string memory _department, string memory _incident, string memory _incident_address) public {
        ticketsMap[_folio] = Ticket(_folio, _department, _incident, _incident_address);
    }

    function getTicket(uint256 _folio) public view returns (Ticket memory) {
        return ticketsMap[_folio];
    }

}