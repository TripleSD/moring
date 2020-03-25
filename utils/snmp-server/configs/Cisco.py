# SNMP server response config example

def my_response(oid):
	res = '|'.join(oid.split('.'))
	return octet_string('response: {}'.format(res))


DATA = {
    '1.3.6.1.2.1.1.1.0': octet_string('Cisco IOS Software (C3560-IPBASE-M), Version 12.2(35)SE5'), # SNMPv2-MIB::sysDescr.0
    '1.3.6.1.2.1.47.1.1.1.1.9.1001': octet_string('12.2(35)SE5'),       # SNMPv2-SMI::mib-2.47.1.1.1.1.9.1001
    '1.3.6.1.2.1.1.3.0': octet_string('294309196'),                     # DISMAN-EVENT-MIB::sysUpTimeInstance
    '1.3.6.1.2.1.1.4.0': octet_string('admin@mail.test'),               # SNMPv2-MIB::sysContact.0
    '1.3.6.1.2.1.1.6.0': octet_string('DC Super'),                      # SNMPv2-MIB::sysLocation.0
    '1.3.6.1.2.1.47.1.1.1.1.11.1001' : octet_string('FOC1217V38H'),     # SNMPv2-SMI::mib-2.47.1.1.1.1.11.1001
    '1.3.6.1.2.1.47.1.1.1.1.13.1001': octet_string('WS-C3560-8PC-S')    # SNMPv2-SMI::mib-2.47.1.1.1.1.13.1001
}

# Example:
# SNMPv2-MIB::sysDescr.0 = STRING: Cisco IOS Software, C3560 Software (C3560-IPBASE-M), Version 12.2(35)SE5, RELEASE SOFTWARE (fc1)
# Copyright (c) 1986-2007 by Cisco Systems, Inc.
# Compiled Thu 19-Jul-07 18:15 by nachen
# DISMAN-EVENT-MIB::sysUpTimeInstance = Timeticks: (294309196) 34 days, 1:31:31.96
# SNMPv2-MIB::sysContact.0 = STRING: admin@mail.test
# SNMPv2-MIB::sysLocation.0 = STRING: DC Super
# SNMPv2-SMI::mib-2.47.1.1.1.1.11.1 = STRING: "FOC1217V38H"
# SNMPv2-SMI::mib-2.47.1.1.1.1.9.1001 = STRING: "12.2(35)SE5"
# SNMPv2-SMI::mib-2.47.1.1.1.1.13.1001 = STRING: "WS-C3560-8PC-S"
