<?php echo '<?php'; ?>

/**
 * The phpLDAPadmin config file
 *
 * This is where you can customise some of the phpLDAPadmin defaults
 * that are defined in config_default.php.
 *
 * To override a default, use the $config->custom variable to do so.
 * For example, the default for defining the language in config_default.php
 *
 * $this->default->appearance['lang'] = array(
 *  'desc'=>'Language',
 *  'default'=>'auto');
 *
 * to override this, use $config->custom->appearance['lang'] = 'en';
 *
 * This file is also used to configure your LDAP server connections.
 *
 * You must specify at least one LDAP server there. You may add
 * as many as you like. You can also specify your language, and
 * many other options.
 *
 * NOTE: Commented out values in this file prefixed by //, represent the
 * defaults that have been defined in config_default.php.
 * Commented out values prefixed by #, dont reflect their default value, you can
 * check config_default.php if you want to see what the default is.
 *
 * DONT change config_default.php, you changes will be lost by the next release
 * of PLA. Instead change this file - as it will NOT be replaced by a new
 * version of phpLDAPadmin.
 */

/*********************************************/
/* Useful important configuration overrides  */
/*********************************************/

/* If you are asked to put pla in debug mode, this is how you do it: */
#  $config->custom->debug['level'] = 255;
#  $config->custom->debug['syslog'] = true;
#  $config->custom->debug['file'] = '/tmp/pla_debug.log';

/* phpLDAPadmin can encrypt the content of sensitive cookies if you set this
   to a big random string. */
// $config->custom->session['blowfish'] = null;

/* The language setting. If you set this to 'auto', phpLDAPadmin will attempt
   to determine your language automatically. Otherwise, available lanaguages
   are: 'ct', 'de', 'en', 'es', 'fr', 'it', 'nl', and 'ru'
   Localization is not complete yet, but most strings have been translated.
   Please help by writing language files. See lang/en.php for an example. */
// $config->custom->appearance['language'] = 'auto';

/* The temporary storage directory where we will put jpegPhoto data
   This directory must be readable and writable by your web server. */
// $config->custom->jpeg['tmpdir'] = "/tmp";     // Example for Unix systems
#  $config->custom->jpeg['tmpdir'] = "c:\\temp"; // Example for Windows systems

/* Set this to (bool)true if you do NOT want a random salt used when
   calling crypt().  Instead, use the first two letters of the user's
   password.  This is insecure but unfortunately needed for some older
   environments. */
#  $config->custom->password['no_random_crypt_salt'] = true;

/* PHP script timeout control. If php runs longer than this many seconds then
   PHP will stop with an Maximum Execution time error. Increase this value from
   the default if queries to your LDAP server are slow. The default is either
   30 seconds or the setting of max_exection_time if this is null. */
// $config->custom->session['timelimit'] = 30;

/*********************************************/
/* Commands                                  */
/*********************************************/

/* Command availability ; if you don't authorize a command the command
   links will not be shown and the command action will not be permitted.
   For better security, set also ACL in your ldap directory. */

/*
$config->custom->commands['all'] = array(
 'home'    => true,
 'external_links' => array('feature'  => true,
                           'bug'      => true,
                           'donation' => true,
                           'help'     => true,
                           'credits'  => true),
 'purge'   => true,
 'schema'  => true,
 'import'  => true,
 'export'  => true,
 'logout'  => true,
 'search'  => array('simple_search'     => true,
                    'predefined_search' => true,
                    'advanced_search'   => true),
 'server_refresh' => true,
 'server_info'    => true,
 'entry_refresh'  => true,
 'entry_move'     => true,
 'entry_internal_attributes_show' => true,
 'entry_delete'  => array('simple_delete' => true,
                          'mass_delete'   => false),
 'entry_rename'  => true,
 'entry_compare' => true,
 'entry_create'  => true,
 'attribute_add'          => true,
 'attribute_add_value'    => true,
 'attribute_delete'       => true,
 'attribute_delete_value' => true);
*/

/*********************************************/
/* Appearance                                */
/*********************************************/

/* If you want to choose the appearance of the tree, specify a class name which
   inherits from the Tree class. */
// $config->custom->appearance['tree'] = "AJAXTree";
#  $config->custom->appearance['tree'] = "HTMLTree";

/* If you want to customise the entry view/edition, specify your factory name which
   inherits from the EntryFactory class.
   The 'DefaultEntryFactory' draws all the attributes of an entry according this
   config file and the ldap schema definition ; the 'TemplateEntryFactory' draws
   an entry according to the template whose regexp matches with the dn. */
#  $config->custom->appearance['entry_factory'] = "DefaultEntryFactory";
// $config->custom->appearance['entry_factory'] = "TemplateEntryFactory";

/* If you want to customise an attribute view/edition, specify your factory name which
   inherits from the AttributeFactory class.
   An AttributeFactory defines which class to use to represent a given attribute */
// $config->custom->appearance['attribute_factory'] = "AttributeFactory";

/* Just show your custom templates. */
// $config->custom->appearance['custom_templates_only'] = false;

/* Disable the default template. */
// $config->custom->appearance['disable_default_template'] = false;

/* Configure what objects are shown in left hand tree */
// $config->custom->appearance['tree_filter'] = '(objectclass=*)';

/* The height and width of the tree. If these values are not set, then
   no tree scroll bars are provided. */
// $config->custom->appearance['tree_height'] = null;
#  $config->custom->appearance['tree_height'] = 600;
// $config->custom->appearance['tree_width'] = null;
#  $config->custom->appearance['tree_width'] = 250;

/*********************************************/
/* Define your LDAP servers in this section  */
/*********************************************/

$i=0;
$ldapservers = new LDAPServers;

/* A convenient name that will appear in the tree viewer and throughout
   phpLDAPadmin to identify this LDAP server to users. */
$ldapservers->SetValue($i,'server','name','<?php echo getenv('APPNAME'); ?> LDAP Server');

/* Examples:
   'ldap.example.com',
   'ldaps://ldap.example.com/',
   'ldapi://%2fusr%local%2fvar%2frun%2fldapi'
           (Unix socket at /usr/local/var/run/ldap) */
$ldapservers->SetValue($i,'server','host','localhost');

/* The port your LDAP server listens on (no quotes). 389 is standard. */
$ldapservers->SetValue($i,'server','port',<?php echo getenv('APPNAME_LDAP_PORT'); ?>);

/* Array of base DNs of your LDAP server. Leave this blank to have phpLDAPadmin
   auto-detect it for you. */
$ldapservers->SetValue($i,'server','base',array('<?php echo getenv('APPNAME_LDAP_SUFFIX'); ?>'));

/* Four options for auth_type:
   1. 'cookie': you will login via a web form, and a client-side cookie will
      store your login dn and password.
   2. 'session': same as cookie but your login dn and password are stored on the
      web server in a persistent session variable.
   3. 'http': same as session but your login dn and password are retrieved via
      HTTP authentication.
   4. 'config': specify your login dn and password here in this config file. No
      login will be required to use phpLDAPadmin for this server.

   Choose wisely to protect your authentication information appropriately for
   your situation. If you choose 'cookie', your cookie contents will be
   encrypted using blowfish and the secret your specify above as
   session['blowfish']. */
$ldapservers->SetValue($i,'server','auth_type','session');

/* The DN of the user for phpLDAPadmin to bind with. For anonymous binds or
   'cookie' or 'session' auth_types, LEAVE THE LOGIN_DN AND LOGIN_PASS BLANK. If
   you specify a login_attr in conjunction with a cookie or session auth_type,
   then you can also specify the login_dn/login_pass here for searching the
   directory for users (ie, if your LDAP server does not allow anonymous binds. */
// $ldapservers->SetValue($i,'login','dn','');
$ldapservers->SetValue($i,'login','dn','<?php echo getenv('APPNAME_LDAP_ROOTDN'); ?>');

/* Your LDAP password. If you specified an empty login_dn above, this MUST also
   be blank. */
// $ldapservers->SetValue($i,'login','pass','');
$ldapservers->SetValue($i,'login','pass','');

/* Use TLS (Transport Layer Security) to connect to the LDAP server. */
// $ldapservers->SetValue($i,'server','tls',false);

/************************************
 *      SASL Authentication         *
 ************************************/

/* Enable SASL authentication LDAP SASL authentication requires PHP 5.x
   configured with --with-ldap-sasl=DIR. If this option is disabled (ie, set to
   false), then all other sasl options are ignored. */
// $ldapservers->SetValue($i,'server','sasl_auth',false);

/* SASL auth mechanism */
// $ldapservers->SetValue($i,'server','sasl_mech','PLAIN');

/* SASL authentication realm name */
// $ldapservers->SetValue($i,'server','sasl_realm','');
#  $ldapservers->SetValue($i,'server','sasl_realm',"example.com");

/* SASL authorization ID name
   If this option is undefined, authorization id will be computed from bind DN,
   using sasl_authz_id_regex and sasl_authz_id_replacement. */
// $ldapservers->SetValue($i,'server','sasl_authz_id', null);

/* SASL authorization id regex and replacement
   When sasl_authz_id property is not set (default), phpLDAPAdmin will try to
   figure out authorization id by itself from bind distinguished name (DN).

   This procedure is done by calling preg_replace() php function in the
   following way:

   $authz_id = preg_replace($sasl_authz_id_regex,$sasl_authz_id_replacement,
    $bind_dn);

   For info about pcre regexes, see:
   - pcre(3), perlre(3)
   - http://www.php.net/preg_replace */
// $ldapservers->SetValue($i,'server','sasl_authz_id_regex',null);
// $ldapservers->SetValue($i,'server','sasl_authz_id_replacement',null);
#  $ldapservers->SetValue($i,'server','sasl_authz_id_regex','/^uid=([^,]+)(.+)/i');
#  $ldapservers->SetValue($i,'server','sasl_authz_id_replacement','$1');

/* SASL auth security props.
   See http://beepcore-tcl.sourceforge.net/tclsasl.html#anchor5 for explanation.
*/
// $ldapservers->SetValue($i,'server','sasl_props',null);

/* If the link between your web server and this LDAP server is slow, it is
   recommended that you set 'low_bandwidth' to true. This will enable
   phpLDAPadmin to forego some "fancy" features to conserve bandwidth. */
// $ldapservers->SetValue($i,'server','low_bandwidth',false);

/* Default password hashing algorithm. One of md5, ssha, sha, md5crpyt, smd5,
   blowfish, crypt or leave blank for now default algorithm. */
// $ldapservers->SetValue($i,'appearance','password_hash','md5');

/* If you specified 'cookie' or 'session' as the auth_type above, you can
   optionally specify here an attribute to use when logging in. If you enter
   'uid' and login as 'dsmith', phpLDAPadmin will search for (uid=dsmith)
   and log in as that user.
   Leave blank or specify 'dn' to use full DN for logging in. Note also that if
   your LDAP server requires you to login to perform searches, you can enter the
   DN to use when searching in 'login_dn' and 'login_pass' above. You may also
   specify 'string', in which case you can provide a string to use for logging
   users in. See 'login_string' directly below. */
// $ldapservers->SetValue($i,'login','attr','dn');

/* If you specified something different from 'dn', for example 'uid', as the
   login_attr above, you can optionally specify here to fall back to
   authentication with dn.
   This is useful, when users should be able to log in with their uid, but
   the ldap administrator wants to log in with his root-dn, that does not
   necessarily have the uid attribute.
   When using this feature, login_class is ignored. */
// $ldapservers->SetValue($i,'login','fallback_dn',false);

/* If you specified 'cookie' or 'session' as the auth_type above, and you
   specified 'string' for 'login_attr' above, you must provide a string here for
   logging users in. If, for example, I have a lot of user entries with DNs like
   "uid=dsmith,ou=People,dc=example,dc=com", then I can specify a string
   "uid=<username>,ou=People,dc=example,dc=com" and my users can login with
   their user names alone, ie: "dsmith" in this case. */
#  $ldapservers->SetValue($i,'login','string','uid=<username>,ou=People,dc=example,dc=com');

/* If 'login_attr' is used above such that phpLDAPadmin will search for your DN
   at login, you may restrict the search to a specific objectClass. EG, set this
   to 'posixAccount' or 'inetOrgPerson', depending upon your setup. */
// $ldapservers->SetValue($i,'login','class',null);

/* Specify true If you want phpLDAPadmin to not display or permit any
   modification to the LDAP server. */
// $ldapservers->SetValue($i,'server','read_only',false);

/* Specify false if you do not want phpLDAPadmin to draw the 'Create new' links
   in the tree viewer. */
// $ldapservers->SetValue($i,'appearance','show_create',true);

/* This feature allows phpLDAPadmin to automatically determine the next
   available uidNumber for a new entry. */
// $ldapservers->SetValue($i,'auto_number','enable',true);

/* The mechanism to use when finding the next available uidNumber. Two possible
   values: 'uidpool' or 'search'.
   The 'uidpool' mechanism uses an existing uidPool entry in your LDAP server to
   blindly lookup the next available uidNumber. The 'search' mechanism searches
   for entries with a uidNumber value and finds the first available uidNumber
   (slower). */
// $ldapservers->SetValue($i,'auto_number','mechanism','search');

/* The DN of the search base when the 'search' mechanism is used above. */
#  $ldapservers->SetValue($i,'auto_number','search_base','ou=People,dc=example,dc=com');

/* The minimum number to use when searching for the next available UID number
   (only when 'search' is used for auto_uid_number_mechanism' */
// $ldapservers->SetValue($i,'auto_number','min',1000);

/* The DN of the uidPool entry when 'uidpool' mechanism is used above. */
// $ldapservers->SetValue($i,'auto_number','uidpool_dn','cn=uidPool,dc=example,dc=com');

/* If you set this, then phpldapadmin will bind to LDAP with this user ID when
   searching for the uidnumber. The idea is, this user id would have full
   (readonly) access to uidnumber in your ldap directory (the logged in user
   may not), so that you can be guaranteed to get a unique uidnumber for your
   directory. */
// $ldapservers->SetValue($i,'auto_number','dn',null);

/* The password for the dn above. */
// $ldapservers->SetValue($i,'auto_number','pass',null);

/* Enable anonymous bind login. */
// $ldapservers->SetValue($i,'login','anon_bind',true);

/* Use customized page with prefix when available. */
#  $ldapservers->SetValue($i,'custom','pages_prefix','custom_');

/* If you set this, then phpldapadmin will bind to LDAP with this user when
   testing for unique attributes (as set in unique_attrs array). If you want to
   enforce unique attributes, than this id should have full (readonly) access
   to the attributes in question (the logged in user may not have enough access)
*/
// $ldapservers->SetValue($i,'unique_attrs','dn',null);

/* The password for the dn above */
// $ldapservers->SetValue($i,'unique_attrs','pass',null);

/* If you set this, then only these DNs are allowed to log in. This array can
   contain individual users, groups or ldap search filter(s). Keep in mind that
   the user has not authenticated yet, so this will be an anonymous search to
   the LDAP server, so make your ACLs allow these searches to return results! */
#  $ldapservers->SetValue($i,'login','allowed_dns',array(
#   'uid=stran,ou=People,dc=example,dc=com',
#   '(&(gidNumber=811)(objectClass=groupOfNames))',
#   '(|(uidNumber=200)(uidNumber=201))',
#   'cn=callcenter,ou=Group,dc=example,dc=com'));

/* Set this if you dont want this LDAP server to show in the tree */
// $ldapservers->SetValue($i,'appearance','visible',true);

/* This is the time out value in minutes for the server. After as many minutes
   of inactivity you will be automatically logged out. If not set, the default
   value will be ( session_cache_expire()-1 ) */
#  $ldapservers->SetValue($i,'login','timeout',30);

/* Set this if you want phpldapadmin to perform rename operation on entry which
   has children. Certain servers are known to allow it, certain are not */
// $ldapservers->SetValue($i,'server','branch_rename',false);

/* If you set this, then phpldapadmin will show these attributes as
   internal attributes, even if they are not defined in your schema. */
// $ldapservers->SetValue($i,'server','custom_sys_attrs',array(''));
#  $ldapservers->SetValue($i,'server','custom_sys_attrs',array('passwordExpirationTime','passwordAllowChangeTime'));

/* If you set this, then phpldapadmin will show these attributes on
   objects, even if they are not defined in your schema. */
// $ldapservers->SetValue($i,'server','custom_attrs',array(''));
#  $ldapservers->SetValue($i,'server','custom_attrs',array('nsRoleDN','nsRole','nsAccountLock'));

/* These attributes will be forced to MAY attributes and become option in the
   templates. If they are not defined in the templates, then they wont appear
   as per normal template processing. You may want to do this becuase your LDAP
   server may automatically calculate a default value.
   In Fedora Directory Server using the DNA Plugin one could ignore uidNumber,
   gidNumber and sambaSID. */
// $ldapservers->SetValue($i,'force_may','attrs',array(''));
#  $ldapservers->SetValue($i,'force_may','attrs',array('uidNumber','gidNumber','sambaSID'));

/**************************************************************************
 * If you want to configure additional LDAP servers, do so below.         *
 * Remove the commented lines and use this section as a template for all  *
 * your other LDAP servers.                                               *
 **************************************************************************/

/*
$i++;
$ldapservers->SetValue($i,'server','name','LDAP Server');
$ldapservers->SetValue($i,'server','host','127.0.0.1');
$ldapservers->SetValue($i,'server','port',389);
$ldapservers->SetValue($i,'server','base',array(''));
$ldapservers->SetValue($i,'server','auth_type','cookie');
$ldapservers->SetValue($i,'login','dn','');
$ldapservers->SetValue($i,'login','pass','');
$ldapservers->SetValue($i,'server','tls',false);
$ldapservers->SetValue($i,'server','low_bandwidth',false);
$ldapservers->SetValue($i,'appearance','password_hash','md5');
$ldapservers->SetValue($i,'login','attr','dn');
$ldapservers->SetValue($i,'login','string',null);
$ldapservers->SetValue($i,'login','class',null);
$ldapservers->SetValue($i,'server','read_only',false);
$ldapservers->SetValue($i,'appearance','show_create',true);
$ldapservers->SetValue($i,'auto_number','enable',true);
$ldapservers->SetValue($i,'auto_number','mechanism','search');
$ldapservers->SetValue($i,'auto_number','search_base',null);
$ldapservers->SetValue($i,'auto_number','min',1000);
$ldapservers->SetValue($i,'auto_number','dn',null);
$ldapservers->SetValue($i,'auto_number','pass',null);
$ldapservers->SetValue($i,'login','anon_bind',true);
$ldapservers->SetValue($i,'custom','pages_prefix','custom_');
$ldapservers->SetValue($i,'unique_attrs','dn',null);
$ldapservers->SetValue($i,'unique_attrs','pass',null);

# SASL auth
$ldapservers->SetValue($i,'server','sasl_auth',true);
$ldapservers->SetValue($i,'server','sasl_mech','PLAIN');
$ldapservers->SetValue($i,'server','sasl_realm','EXAMPLE.COM');
$ldapservers->SetValue($i,'server','sasl_authz_id',null);
$ldapservers->SetValue($i,'server','sasl_authz_id_regex','/^uid=([^,]+)(.+)/i');
$ldapservers->SetValue($i,'server','sasl_authz_id_replacement','$1');
$ldapservers->SetValue($i,'server','sasl_props',null);
*/

/*********************************************/
/* User-friendly attribute translation       */
/*********************************************/

/* Use this array to map attribute names to user friendly names. For example, if
   you don't want to see "facsimileTelephoneNumber" but rather "Fax". */
$friendly_attrs = array();

$friendly_attrs['facsimileTelephoneNumber'] = 'Fax';
$friendly_attrs['telephoneNumber']          = 'Phone';
$friendly_attrs['uid']                      = 'User Name';

/*********************************************/
/* Support for attrs display order           */
/*********************************************/

/* Use this array if you want to have your attributes displayed in a specific
   order. You can use default attribute names or their fridenly names.
   For example, "sn" will be displayed right after "givenName". All the other
   attributes that are not specified in this array will be displayed after in
   alphabetical order. */
#  $attrs_display_order = array(
#   'givenName',
#   'sn',
#   'cn',
#   'displayName',
#   'uid',
#   'uidNumber',
#   'gidNumber',
#   'homeDirectory',
#   'mail',
#   'userPassword'
#  );

/*********************************************/
/* Hidden attributes                         */
/*********************************************/

/* You may want to hide certain attributes from being displayed in the editor
   screen. Do this by adding the desired attributes to this list (and uncomment
   it). This only affects the editor screen. Attributes will still be visible in
   the schema browser and elsewhere. An example is provided below:
   NOTE: The user must be able to read the hidden_except_dn entry to be
   excluded. */
#  $hidden_attrs = array( 'jpegPhoto', 'objectClass' );
#  $hidden_except_dn = "cn=PLA UnHide,ou=Groups,c=AU";

/* Hidden attributes in read-only mode. If undefined, it will be equal to
   $hidden_attrs. */
#  $hidden_attrs_ro = array(
#   'objectClass','shadowWarning', 'shadowLastChange', 'shadowMax',
#   'shadowFlag', 'shadowInactive', 'shadowMin', 'shadowExpire');

/**                                         **/
/** Read-only attributes                    **/
/**                                         **/

/* You may want to phpLDAPadmin to display certain attributes as read only,
   meaning that users will not be presented a form for modifying those
   attributes, and they will not be allowed to be modified on the "back-end"
   either. You may configure this list here:
   NOTE: The user must be able to read the read_only_except_dn entry to be
   excluded. */
#  $read_only_attrs = array( 'objectClass' );
#  $read_only_except_dn = "cn=PLA ReadWrite,ou=Groups,c=AU";

/* An example of how to specify multiple read-only attributes: */
#  $read_only_attrs = array( 'jpegPhoto', 'objectClass', 'someAttribute' );

/*********************************************/
/* Unique attributes                         */
/*********************************************/

/* You may want phpLDAPadmin to enforce some attributes to have unique values
   (ie: not belong to other entries in your tree. This (together with
   unique_attrs['dn'] and unique_attrs['pass'] option will not let updates to
   occur with other attributes have the same value.
   NOTE: Currently the unique_attrs is NOT enforced when copying a dn. (Need to
   present a user with the option of changing the unique attributes. */
#  $unique_attrs = array('uid','uidNumber','mail');

/*********************************************/
/* Group attributes                          */
/*********************************************/

/* Add "modify group members" link to the attribute. */
// $config->custom->modify_member['groupattr'] = array('member','uniqueMember','memberUid');

/* Configure filter for member search. This only applies to "modify group members" feature */
// $config->custom->modify_member['filter'] = '(objectclass=Person)';

/* Attribute that is added to the group member attribute. */
// $config->custom->modify_member['attr'] = 'dn';

/*********************************************/
/* Predefined Queries (canned views)         */
/*********************************************/

/* To make searching easier, you may setup predefined queries below: */
$q=0;
$queries = array();

/* The name that will appear in the simple search form */
$queries[$q]['name'] = 'User List';

/* The base to search on */
$queries[$q]['base'] = 'dc=example,dc=com';

/* The search scope (sub, base, one) */
$queries[$q]['scope'] = 'sub';

/* The LDAP filter to use */
$queries[$q]['filter'] = '(&(objectClass=posixAccount)(uid=*))';

/* The attributes to return */
$queries[$q]['attributes'] = 'cn, uid, homeDirectory, telephonenumber, jpegphoto';

/* If you want to configure more pre-defined queries, copy and paste the above (including the "$q++;") */
$q++;
$queries[$q]['name'] = 'Samba Users';
$queries[$q]['base'] = 'dc=example,dc=com';
$queries[$q]['scope'] = 'sub';
$queries[$q]['filter'] = '(&(|(objectClass=sambaAccount)(objectClass=sambaSamAccount))(objectClass=posixAccount)(!(uid=*$)))';
$queries[$q]['attributes'] = 'uid, smbHome, uidNumber';

$q++;
$queries[$q]['name'] = 'Samba Computers';
$queries[$q]['base'] = 'dc=example,dc=com';
$queries[$q]['scope'] = 'sub';
$queries[$q]['filter'] = '(&(objectClass=sambaAccount)(uid=*$))';
$queries[$q]['attributes'] = 'uid, homeDirectory';

$f_include = dirname(__FILE__).'/config.local.php';
if (file_exists($f_include)) {
  include $f_include;
}
