*   Start SNMP server

    ```bash
    python snmp-server.py -p 9005
    ```
    When will server started you can see message:
    
    ```bash
    SNMP server listening on 0.0.0.0:9005
    ```
    
*   Send command:

    ```bash
    snmpwalk -v2c -c public 127.0.0.1:9005 SNMPv2-MIB::sysDescr.0
    ```
*   Answer from virtual SNMP server

    ```bash
    SNMPv2-MIB::sysDescr.0 = STRING: 1.3.6.1.2.1.1.1.0
    ```

