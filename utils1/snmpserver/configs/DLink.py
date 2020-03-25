# SNMP server response config example

def my_response(oid):
	res = '|'.join(oid.split('.'))
	return octet_string('response: {}'.format(res))


DATA = {
    '1.3.6.1.2.1.16.19.2.0': octet_string('1.16.B002'),             # SNMPv2-SMI::mib-2.16.19.2.0
    '1.3.6.1.2.1.1.3.0': octet_string('2520849600'),                # DISMAN-EVENT-MIB::sysUpTimeInstance
    '1.3.6.1.2.1.1.4.0': octet_string('admin@mail.test'),           # SNMPv2-MIB::sysContact.0
    '1.3.6.1.2.1.1.6.0': octet_string('DC Super'),                  # SNMPv2-MIB::sysLocation.0
    '1.3.6.1.2.1.47.1.1.1.1.11.1' : octet_string('RZ1O1DA000532'),  # SNMPv2-SMI::mib-2.47.1.1.1.1.11.1
    '1.3.6.1.2.1.47.1.1.1.1.7.1': octet_string('DGS-3000-10TC')     # SNMPv2-SMI::mib-2.47.1.1.1.1.7.1
}

# Example:
# SNMPv2-MIB::sysDescr.0 = STRING: DGS-3000-10TC Gigabit Ethernet Switch
# DISMAN-EVENT-MIB::sysUpTimeInstance = Timeticks: (2520849600) 291 days, 18:21:36.00
# SNMPv2-MIB::sysContact.0 = STRING: admin@mail.test
# SNMPv2-MIB::sysLocation.0 = STRING: DC Super
# SNMPv2-SMI::mib-2.47.1.1.1.1.11.1 = STRING: "RZ1O1DA000532"
# SNMPv2-SMI::mib-2.16.19.2.0 = STRING: "1.16.B002"
# SNMPv2-SMI::mib-2.47.1.1.1.1.7.1 = STRING: "DGS-3000-10TC"
