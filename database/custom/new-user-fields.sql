ALTER TABLE users
ADD last_name varchar(255) NOT NULL DEFAULT "",
ADD recovery_email varchar(255) NOT NULL DEFAULT ""

after address;

ALTER TABLE user_profiles
ADD facebook_link varchar(255) NOT NULL DEFAULT "",
ADD twitter_link varchar(255) NOT NULL DEFAULT "",

ADD street varchar(255) NOT NULL DEFAULT "",
ADD apartment varchar(255) NOT NULL DEFAULT "",
ADD city varchar(255) NOT NULL DEFAULT "",
ADD country varchar(255) NOT NULL DEFAULT "",
ADD state varchar(255) NULL DEFAULT "",
ADD zip varchar(255) DEFAULT 0

after address