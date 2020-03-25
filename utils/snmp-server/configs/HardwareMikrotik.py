# SNMP server response config example

def my_response(oid):
	res = '|'.join(oid.split('.'))
	return octet_string('response: {}'.format(res))


DATA = {
    '1.3.6.1.2.1.1.1.0': octet_string('RouterOS RB751U-2HnD'),      # SNMPv2-MIB::sysDescr.0
    '1.3.6.1.4.1.14988.1.1.7.4.0': octet_string('6.46'),            # SNMPv2-SMI::enterprises.14988.1.1.7.4.0
    '1.3.6.1.2.1.1.4.0': octet_string('admin@mail.test'),           # SNMPv2-MIB::sysContact.0
    '1.3.6.1.2.1.1.6.0': octet_string('DC Super'),                  # SNMPv2-MIB::sysLocation.0
    '1.3.6.1.4.1.14988.1.1.7.3.0': octet_string('45E4028BDAC3'),    # SNMPv2-SMI::enterprises.14988.1.1.7.3.0
    '1.3.6.1.4.1.14988.1.1.4.3.0': integer(4),                      # SNMPv2-SMI::enterprises.14988.1.1.4.3.0
    '1.3.6.1.4.1.14988.1.1.4.4.0': octet_string('6.46.4'),          # SNMPv2-SMI::enterprises.14988.1.1.4.4.0
    '1.3.6.1.2.1.1.3.0': octet_string('199964800'),                 # DISMAN-EVENT-MIB::sysUpTimeInstance
}

# Example:
# SNMPv2-MIB::sysDescr.0 = STRING: RouterOS RB751U-2HnD
# DISMAN-EVENT-MIB::sysUpTimeInstance = Timeticks: (199964800) 23 days, 3:27:28.00
# SNMPv2-MIB::sysContact.0 = STRING: admin@mail.test
# SNMPv2-MIB::sysLocation.0 = STRING: DC Super
# SNMPv2-SMI::enterprises.14988.1.1.4.3.0 = INTEGER: 4
# SNMPv2-SMI::enterprises.14988.1.1.4.4.0 = STRING: "6.46.4"
# SNMPv2-SMI::enterprises.14988.1.1.7.3.0 = STRING: "45E4028BDAC3"
# SNMPv2-SMI::enterprises.14988.1.1.7.4.0 = STRING: "6.46"
