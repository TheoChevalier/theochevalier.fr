
CREATE TABLE IF NOT EXISTS tc_articles (
  art_id int(11) NOT NULL,
  titre_fr varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  titre_en varchar(255) NOT NULL,
  `date` varchar(12) NOT NULL,
  date_update_fr varchar(12) NOT NULL,
  date_update_en varchar(12) NOT NULL,
  texte_fr longtext CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  texte_en longtext NOT NULL,
  art_img varchar(255) NOT NULL DEFAULT 'default.jpg',
  keywords varchar(255) NOT NULL,
  categorie varchar(50) NOT NULL,
  UNIQUE KEY id (art_id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tc_com (
  com_id int(11) NOT NULL AUTO_INCREMENT,
  com_mail varchar(100) NOT NULL,
  com_hash varchar(255) NOT NULL,
  com_nom varchar(100) NOT NULL,
  com_site varchar(255) NOT NULL,
  com_msg text NOT NULL,
  com_art int(11) NOT NULL,
  com_date int(11) NOT NULL,
  com_lang varchar(2) NOT NULL,
  PRIMARY KEY (com_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS tc_follow (
  article int(11) NOT NULL,
  email varchar(100) NOT NULL,
  follow varchar(1) NOT NULL,
  PRIMARY KEY (article,email)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
