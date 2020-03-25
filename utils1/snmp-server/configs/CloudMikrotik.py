# SNMP server response config example

def my_response(oid):
	res = '|'.join(oid.split('.'))
	return octet_string('response: {}'.format(res))


DATA = {
    '1.3.6.1.2.1.1.1.0': octet_string('RouterOS CHR'),      # SNMPv2-MIB::sysDescr.0
    '1.3.6.1.4.1.14988.1.1.7.4.0': octet_string(''),        # SNMPv2-SMI::enterprises.14988.1.1.7.4.0
    '1.3.6.1.4.1.14988.1.1.4.4.0': octet_string(''),        # SNMPv2-SMI::enterprises.14988.1.1.4.4.0
    '1.3.6.1.2.1.1.3.0': octet_string('199892900'),         # DISMAN-EVENT-MIB::sysUpTimeInstance
    '1.3.6.1.2.1.1.4.0': octet_string('admin@mail.test'),   # SNMPv2-MIB::sysContact.0
    '1.3.6.1.2.1.1.6.0': octet_string('DC Super'),          # SNMPv2-MIB::sysLocation.0
    '1.3.6.1.4.1.14988.1.1.7.3.0': octet_string(''),        # SNMPv2-SMI::enterprises.14988.1.1.7.3.0
    '1.3.6.1.4.1.14988.1.1.4.3.0': integer(1),              # SNMPv2-SMI::enterprises.14988.1.1.4.3.0
}

# Example:
# SNMPv2-MIB::sysDescr.0 = STRING: RouterOS CHR
# DISMAN-EVENT-MIB::sysUpTimeInstance = Timeticks: (199892900) 23 days, 3:15:29.00
# SNMPv2-MIB::sysContact.0 = STRING: admin@mail.test
# SNMPv2-MIB::sysLocation.0 = STRING: DC Super
# SNMPv2-SMI::enterprises.14988.1.1.4.3.0 = INTEGER: 1
# SNMPv2-SMI::enterprises.14988.1.1.4.4.0 = STRING: "6.46.4
