#
# Table structure for table 'tx_koninginstagram_domain_model_credential'
#
CREATE TABLE tx_koninginstagram_domain_model_credential (
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0',
    tstamp int(11) DEFAULT '0' NOT NULL,
    crdate int(11) DEFAULT '0' NOT NULL,
    cruser_id int(11) DEFAULT '0' NOT NULL,
    editlock tinyint(4) DEFAULT '0' NOT NULL,

    user_id varchar(255) DEFAULT '',
    username varchar(255) DEFAULT '',
    access_token varchar(255) DEFAULT '',

    PRIMARY KEY (uid)
);
