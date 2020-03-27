# SNMP server response config example

def my_response(oid):
	res = '|'.join(oid.split('.'))
	return octet_string('response: {}'.format(res))


DATA = {
    '1.3.6.1.2.1.1.1.0': octet_string('MES2324B 28-port 1G/10G Managed Switch'),    # SNMPv2-MIB::sysDescr.0
    '1.3.6.1.2.1.47.1.1.1.1.10.67108992': octet_string('4.0.7'),                    # SNMPv2-SMI::mib-2.47.1.1.1.1.10.67108992
    '1.3.6.1.2.1.1.3.0': octet_string('2409917400'),                                # DISMAN-EVENT-MIB::sysUpTimeInstance
    '1.3.6.1.2.1.1.4.0': octet_string('admin@mail.test'),                           # SNMPv2-MIB::sysContact.0
    '1.3.6.1.2.1.1.6.0': octet_string('DC Super'),                                  # SNMPv2-MIB::sysLocation.0
    '1.3.6.1.2.1.47.1.1.1.1.11.67108992' : octet_string('ES32001131'),              # SNMPv2-SMI::mib-2.47.1.1.1.1.11.67108992
    '1.3.6.1.2.1.47.1.1.1.1.13.67108992': octet_string('MES2324B')                  # SNMPv2-SMI::mib-2.47.1.1.1.1.13.67108992
}

# Example:
# SNMPv2-MIB::sysDescr.0 = STRING: MES2324B 28-port 1G/10G Managed Switch
# SNMPv2-MIB::sysObjectID.0 = OID: SNMPv2-SMI::enterprises.35265.1.83
# DISMAN-EVENT-MIB::sysUpTimeInstance = Timeticks: (2409917400) 278 days, 22:12:54.00
# SNMPv2-MIB::sysContact.0 = STRING: admin@mail.test
# SNMPv2-MIB::sysLocation.0 = STRING: DC Super
# SNMPv2-SMI::mib-2.47.1.1.1.1.11.67108992 = STRING: "ES32001131"
# SNMPv2-SMI::mib-2.47.1.1.1.1.10.67108992 = STRING: "4.0.7"
# SNMPv2-SMI::mib-2.47.1.1.1.1.13.67108992 = STRING: "MES2324B"
