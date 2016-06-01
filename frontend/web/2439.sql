-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Machine: localhost:3306
-- Gegenereerd op: 23 dec 2015 om 09:12
-- Serverversie: 5.5.34
-- PHP-versie: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `yachtmanager`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 1, 1418728926),
('sailor', 20, 1426687445),
('sailor', 38, 1447247202),
('sailor', 39, 1449475677),
('sailor', 45, 1450857571),
('sailor', 47, 1450858244);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Admin', NULL, NULL, 0, 0),
('createYacht', 2, 'Create a yacht', NULL, NULL, 1426934788, 1426934788),
('createYachtOwner', 2, 'Create a yacht owner', NULL, NULL, NULL, NULL),
('createYachtOwnerSelf', 2, 'CreateYachtOwner ', NULL, NULL, NULL, NULL),
('getYachtStatistics', 2, 'Mag de gebruiker statistieken op hallen van een of meerdere yachten', 'isOwner', NULL, NULL, NULL),
('manageMaintenance', 2, 'View,Update en Delete', NULL, NULL, NULL, NULL),
('manageOwnMaintenance', 2, 'allen eiegen', 'isOwner', NULL, NULL, NULL),
('notFinished', 1, 'Gebruiker met nog niet genoeg gegevens', NULL, NULL, 0, 0),
('sailor', 1, 'Sailor', NULL, NULL, 0, 0),
('updateOwnYacht', 2, 'update,delete', 'isOwner', NULL, 1426936015, 1426936015),
('updateYacht', 2, '', NULL, NULL, 1426934788, 1426934788);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('sailor', 'createYacht'),
('admin', 'createYachtOwner'),
('createYachtOwnerSelf', 'createYachtOwner'),
('sailor', 'createYachtOwnerSelf'),
('sailor', 'getYachtStatistics'),
('admin', 'manageMaintenance'),
('manageOwnMaintenance', 'manageMaintenance'),
('sailor', 'manageOwnMaintenance'),
('admin', 'sailor'),
('sailor', 'updateOwnYacht'),
('admin', 'updateYacht'),
('updateOwnYacht', 'updateYacht');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isOwner', 'O:32:"common\\components\\rbac\\OwnerRule":3:{s:4:"name";s:7:"isOwner";s:9:"createdAt";i:1446720058;s:9:"updatedAt";i:1446720058;}', 1446720058, 1446720058);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` varchar(10) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden geëxporteerd voor tabel `country`
--

INSERT INTO `country` (`id`, `name`, `code`, `deleted`) VALUES
(1, 'Netherlands', '', 0),
(2, 'United Kingdom', '', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `handicap`
--

CREATE TABLE `handicap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` tinyblob NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Gegevens worden geëxporteerd voor tabel `handicap`
--

INSERT INTO `handicap` (`id`, `name`, `description`, `deleted`) VALUES
(4, 'SW', 0x48616e64696361707379737465656d20766f6f72207265637265617469652d7a65696c657273, 0),
(5, 'ORC', 0x4f666673686f726520526163696e6720436f756e63696c, 0),
(6, 'IRC', 0x49524320697320612073797374656d206f662068616e646963617070696e67207361696c626f61747320616e642079616368747320666f722074686520707572706f7365206f6620726163696e672e204974206973206d616e616765642062792074686520526f79616c204f6365616e20526163696e6720436c756220696e2074686520556e69746564204b696e67646f6d207468726f7567682074686569722064656469636174656420526174696e67204f66666963652e, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `handicap_yacht`
--

CREATE TABLE `handicap_yacht` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `handicap_id` int(11) NOT NULL,
  `yacht_id` int(11) NOT NULL,
  `value` double NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `handicap_id` (`handicap_id`,`yacht_id`),
  KEY `yacht_id` (`yacht_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden geëxporteerd voor tabel `handicap_yacht`
--

INSERT INTO `handicap_yacht` (`id`, `handicap_id`, `yacht_id`, `value`, `deleted`) VALUES
(2, 4, 41, 105, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yacht_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` blob NOT NULL,
  `date_executed` date DEFAULT '0000-00-00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) NOT NULL,
  `executed_by` tinyint(1) NOT NULL DEFAULT '0',
  `user_created` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `yacht_id` (`yacht_id`,`user_created`),
  KEY `user_created` (`user_created`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Gegevens worden geëxporteerd voor tabel `maintenance`
--

INSERT INTO `maintenance` (`id`, `yacht_id`, `name`, `description`, `date_executed`, `status`, `priority`, `executed_by`, `user_created`, `created`, `updated`, `deleted`) VALUES
(17, 41, 'Grootzeilval vervangen', '', '2014-03-01', 0, 2, 0, 20, '0000-00-00 00:00:00', '2015-12-21 09:29:00', 1),
(18, 41, 'Genuaval vervangen', 0x4f70206465206869737761206e69657577652064796e65656d612067656e756176616c2067656b6f6368742076616e203238206d657465722e20486f70656e206461742069652070617374, '2015-03-28', 0, 2, 0, 20, '2015-03-16 20:46:47', '2015-03-16 20:46:47', 0),
(19, 41, 'Nieuwe landvasten', 0x34206e6965757765206c616e6476617374656e, '2015-03-13', 0, 2, 0, 20, '2015-03-16 20:47:43', '2015-03-16 20:47:43', 0),
(20, 41, 'Liggeld seizoen 2015', 0x46616374757572203131206d616172740d0a4c696767656c6420626f78203120617072696c20746f742031206f6b746f6265722032303135, '2015-04-28', 0, 2, 0, 20, '2015-03-16 20:48:54', '2015-03-16 20:48:54', 0),
(21, 41, 'Bakskist SB achter scharnier', 0x4b69742f206c6f636b746974652f20427574796c746170653f20566f6f722061666469636874696e670d0a4d6f6574207765657220696e2064652065706f787920776f7264656e206765626f6f7264207a6f6461742064652073636861726e6965722065722077656572206b616e20776f7264656e20696e67656472616169642e, '2015-04-12', 0, 2, 0, 20, '2015-03-17 10:25:05', '2015-03-17 10:25:05', 0),
(22, 41, 'Voorstag vervangen', 0x426f76656e696e207a6174656e207477656520737472656e67656e206c6f732c206e696575776520766f6f7273746167206572696e2e, '2013-03-01', 0, 2, 1, 20, '2015-03-17 11:33:41', '2015-03-17 11:33:41', 0),
(23, 41, 'GPS Navigatie', 0x5669612065656e2047505320616e74656e6e6520656e20706c6f742d6f706c6f7373696e67206b756e6e656e206e617669676572656e2e20486574206d6f6f6973746520697320646174206572206f6f6b2065656e20414953206f6e7476616e6765722062696a7a697420656e2064617420657220616c6c652061707061726174656e206d657420656c6b616172206b756e6e656e2070726174656e2e200d0a0d0a496e2064652068756964696765207369747561746965206973206572206765656e206c6f7373652047505320656e206973206d6f6d656e7465656c20616c6c65656e2064652077696e64736e656c68656964206f702074652076726167656e20766961204e4d45412e0d0a0d0a2a205569747a6f656b656e206f66206d617269666f6f6e206f6f6b20475053206b616e20646973706c6179656e0d0a2a20416e7469736c6970206d61746a6520766f6f72206465206c6170746f700d0a0d0a475053202b2041495320616e74656e6e653a20687474703a2f2f7777772e796f75726d6172696e652e6e6c2f57656277696e6b656c2d50726f647563742d39303636383731352f4469676974616c2d59616368742d475633302d4149532d5648462d4750532d616e74656e6e652e68746d6c3f75746d5f736f757263653d6d61726b74706c616174732675746d5f6d656469756d3d6370632d6d61726b74706c616174732675746d5f63616d706169676e3d6d61726b74706c61617473, '0000-00-00', 0, 1, 0, 20, '0000-00-00 00:00:00', '2015-12-16 13:21:06', 0),
(24, 41, 'Interieurlampjes vervangen door LED', 0x416c6c6520696e746572696575726c616d706a65732076657276616e67656e20646f6f72204c4544206c616d706a65732e0d0a0d0a46697474696e67203420636d206272656564, '0000-00-00', 0, 3, 0, 20, '0000-00-00 00:00:00', '2015-12-16 13:22:23', 0),
(25, 41, 'Achterstuk op giek', 0x4b696a6b656e206f662065722065656e206e6965757765206b6170206f70206b616e206d65742064616172696e20626c6f6b6a657320766f6f72206f6e6465726c696a6b737472656b6b65722e0d0a436865636b656e2062696a20616e6465726520457461707320686f65207a65206865742068656262656e2e, '0000-00-00', 0, 3, 0, 20, '0000-00-00 00:00:00', '2015-12-16 13:22:35', 0),
(26, 41, 'Riflijn 2e rif', 0x4e6965757765206c696a6e206b6f70656e203132206d657465722031306d6d2064696b, '0000-00-00', 0, 0, 0, 20, '0000-00-00 00:00:00', '2015-12-16 13:22:48', 0),
(27, 41, 'Valstoppers', 0x56616c73746f707065727320736c697070656e2064656e6b20696b2e0d0a0d0a48756964696765206d6174656e3a204242203131636d206c616e6720362c36636d2062726565640d0a5342203278207365746a652076616e20322e2031207365746a6520697320342c35206272656564, '0000-00-00', 0, 4, 0, 20, '0000-00-00 00:00:00', '2015-12-16 13:22:59', 0),
(28, 41, 'Schuim om onderstel stroomhaspel', 0x44696520706f74656e20726f657374656e20656e206c6174656e2061662e2056616e206461742069736f6c6174696573636875696d2065726f6d6865656e, '2015-07-18', 0, 2, 0, 20, '2015-03-29 14:10:32', '2015-03-29 14:10:32', 0),
(29, 42, 'Roer opvullen en lamineren', 0x52657374207569747672657a656e0d0a4d65742066c3b6686e2064726f6f67626c617a656e0d0a4f7076756c6c656e206d65742065706f78792070696e64616b6161730d0a4e6965757765206d617474656e20696e6c616d696e6572656e0d0a4f7665726c617070656e6465206d61746a6573206b6e697070656e200d0a4e61742d696e2d6e6174206c616d696e6572656e, '2015-03-28', 0, 2, 0, 31, '2015-03-29 18:15:48', '2015-03-29 18:15:48', 0),
(30, 41, 'Genua rol val geleiders', 0x47656e756120726f6c2076616c2067656c6569646572732061616e207363657074657273, '0000-00-00', 0, 4, 0, 20, '2002-12-02 12:00:00', '2015-12-16 13:30:11', 0),
(31, 41, 'Radio aansluiting', 0x4e6965757765207374656b6b657220766f6f7220726164696f2c206b726f6f6e737465656e746a65730d0a, '2015-06-14', 0, 2, 0, 20, '2015-04-05 10:32:29', '2015-04-05 10:32:29', 0),
(32, 43, 'Rondhouten 2015', 0x5363687572656e20656e206c616b6b656e20726f6e64686f7574656e3a0d0a4d6173742031206b6565722061666c616b0d0a4769656b2031206b6565722061666c616b0d0a426f6f6d2031206b6565722061666c616b0d0a47616666656c206e6965742067656461616e, '2015-04-25', 0, 2, 0, 33, '2015-04-22 22:32:27', '2015-04-22 22:32:27', 0),
(33, 43, 'Spuiten romp plus kuip', 0x5370756974656e20726f6d7020656e206b75697020626f76656e2064652077617465726c696a6e, '2014-04-04', 0, 2, 1, 33, '2015-04-22 22:34:57', '2015-04-22 22:34:57', 0),
(34, 41, '2 50mm lewmar blokken', 0x416c7661737420766f6f722064652067656e6e616b65722e2042696a2047656f726765206b6e69657374, '2015-05-09', 0, 2, 0, 20, '2015-05-11 12:30:53', '2015-05-11 12:30:53', 0),
(35, 41, 'Gennaker sheets', 0x746f757762657374656c6c656e2e6e6c0d0a4e6f6720736861636b6c6573206d616b656e2076616e2044796e65656d6120766f6f72206170656b6c6f6f7420656e206265766573746967696e6720626c6f6b6b656e206f70206465206b696b6b657273206163687465726f7020646520626f6f743b20366d6d20534b37352e, '2015-08-01', 0, 2, 0, 20, '0000-00-00 00:00:00', '2015-09-14 15:07:31', 0),
(36, 41, 'Toilet', 0x506f6d7074206e696574206d6565722e0d0a0d0a426f76656e7374652067656465656c7465206c6f7367656861616c642c2068656e64656c746a652062656b656b656e20656e20676f65642067657a65742e20446161726e61207765726b74652068657420776565722e2053636861726e69657264696e67206469652068656e64656c746a652062657765656774206c65656b20776174206166676562726f6b656e2e, '2015-05-16', 0, 2, 0, 20, '2015-05-14 12:23:33', '2015-05-14 12:23:33', 0),
(37, 41, 'Huik vervangen', 0x5a77617274652c2076616e204d2d7361696c73, '2015-05-28', 0, 2, 0, 20, '2015-06-15 14:04:13', '2015-06-15 14:04:13', 0),
(38, 41, 'Gennaker', 0x4e69657577652067656e6e616b65722067656b6f6368742062696a204d2d7361696c732e0d0a0d0a2d414c4c524f554e44204f46462d53484f524520564f4f524c494a4b2049532031302c33206d65746572730d0a6f70706572766c616b74652034372c39206d32204f4e4445524c494a4b20495320352c34206d65746572730d0a646f656b736f6f727420312c3530204f7a20282b2f2d2036342067722f6d322029204368616c6c656e67652046696265726d6178203634205072656d69756d204e796c6f6e0d0a7374696b73656c6472616164206973207a656577617465722062657374656e64696720656e207569746765766f65726420696e207472696d6f74696f6e2d7374697463680d0a7374696b73656c6472616164206d65726b3a2048656d696e776179202620426172746c657474204461626f6e6420323030302055562073746162696c697365640d0a5256532072696e67656e206d65742077656262696e6720766572737465766967696e67656e20696e20646520686f656b656e0d0a72616469616c652063697263756c6169726520766572737465766967696e67656e20696e20646520686f656b656e200d0a696e636c757369656620726567756c6565726c696a6e20696e20686574206163687465726c696a6b2026206f6e6465726c696a6b, '2015-05-28', 0, 2, 0, 20, '2015-06-15 14:06:16', '2015-06-15 14:06:16', 0),
(39, 41, 'Scheur achterlijk grote genua', 0x476f656465206f706c6f7373696e6720626564656e6b656e20766f6f72206163687465726c696a6b626573636865726d696e672e0d0a496e7465727a65696c207777772e696e7465727a65696c2e6e6c2c204a65726f656e20536d6974, '2015-06-24', 0, 2, 1, 20, '2015-06-16 13:45:07', '2015-06-16 13:45:07', 0),
(40, 41, 'Stiksel kleine genua los', 0x31206261616e2069732061616e20686574206163687465726c696a6b20686574207374696b73656c206c6f7367657261616b74, '2015-08-27', 0, 2, 1, 20, '0000-00-00 00:00:00', '2015-08-29 10:32:05', 0),
(41, 41, 'Brandblusser keuren', 0x4b616e2062696a204e6f20466c616d650d0a476f74656e6275726777656720370d0a3937323320544b2047726f6e696e67656e2c20546865204e65746865726c616e6473, '0000-00-00', 0, 2, 0, 20, '2015-06-18 09:27:48', '2015-06-18 09:27:48', 0),
(42, 41, 'Lekkage raampje SB achter ', 0x4572206c656b746520776174657220646f6f7220646520766f6f7273746520626f76656e73746520736368726f65662e20536368726f65662065727569742067656861616c642c207363686f6f6e67656d61616b742c206c6f636b746974652065726f6d6865656e20656e206572207765657220696e2067656472616169642e204f6f6b20776174206c6f636b7469746520696e2065656e207363686575722076616e20686574206b6974206765736d656572642e204c696a6b74206e75207465207a696a6e206f7067656c6f73742e, '2015-07-03', 0, 2, 0, 20, '2015-07-04 09:17:38', '2015-07-04 09:17:38', 0),
(43, 41, 'Teak onderhouden', '', '0000-00-00', 0, 2, 0, 20, '2015-07-04 15:48:23', '2015-07-04 15:48:23', 0),
(44, 41, 'Puntbeslag verven', 0x456572737420776174206f707363687572656e2e200d0a4d6f656b65206865656674206865742075697465696e64656c696a6b2068656c656d61616c20676566696b7374206d6574203220636f6d706f6e656e74656e206f6e6465726c6161672e, '2015-08-26', 0, 2, 0, 20, '0000-00-00 00:00:00', '2015-09-14 15:09:24', 0),
(45, 41, 'Dakluik kajuit', 0x4c656b7420736f6d732e2052756262657220676f656420636865636b656e2e2053696b61666c6578206d65656e656d656e2e, '0000-00-00', 0, 0, 0, 20, '2015-07-13 13:22:22', '2015-07-13 13:22:22', 0),
(46, 41, 'Beurt motor 2015', 0x4e6965757765206f6c69652c206e696575776520696d70656c6c65722c206e6965757765202e2e2e, '2015-07-16', 0, 0, 1, 20, '2015-07-17 08:46:02', '2015-07-17 08:46:02', 0),
(47, 41, '12 volt lader', 0x48696a206d6f65742074656c65666f6f6e206b756e6e656e206c6164656e20616c73206465206d6f746f722061616e2069732e205765726b74206e69657420313030252067656c6f6f6620696b2e200d0a0d0a5765726b742075697465696e64656c696a6b2077656c2e2048616e67742076616e206465206c616465722061662e205a69742067656b6f7070656c642061616e206d617269666f6f6e20736368616b656c6161722e, '2015-08-09', 0, 0, 0, 20, '2015-08-04 09:42:06', '2015-08-04 09:42:06', 0),
(48, 41, 'Duits vlaggetje', '', '2015-08-21', 0, 2, 0, 20, '0000-00-00 00:00:00', '2015-08-21 14:10:56', 0),
(49, 41, 'Scheurtje onderlijk grote genua', 0x496e2068657420646f656b2c206b616e2077656c206f7067656c6f737420776f7264656e206d6574207a65696c746170652e205a45494c54415045204b4f50454e0d0a, '2015-08-30', 0, 2, 0, 20, '0000-00-00 00:00:00', '2015-09-09 11:27:50', 0),
(50, 41, '12 volt meter bij schakelaar', 0x4765656674206e6965742068657420646161647765726b656c696a6b6520766f6c7461676520776565722e204c6f73736368726f6576656e20656e2064726164656e20636865636b656e2e0d0a0d0a4c6f736765736368726f65666420656e2064726161642076616e20736368616b656c70616e65656c206e61617220766f6c746d65746572206973206272616b2e205a77617274207a69742070726f766f736f7269736368207661737420656e20646520726f6465206b6c656d20697320776174206f75642e0d0a4d6f67656c696a6b206e69657577206b6162656c746a652074757373656e20706c61617473656e2e2044726161642061616e20566f6c746d65746572207a69742077656c20776174206c617374696720766173742e, '0000-00-00', 0, 2, 0, 20, '2015-08-10 13:58:09', '2015-08-10 13:58:09', 0),
(51, 41, 'Verven zwarte banden kajuitopbouw', 0x4b6c657572207569747a6f656b656e, '0000-00-00', 0, 2, 0, 20, '2015-08-10 15:06:06', '2015-08-10 15:06:06', 0),
(52, 41, 'Dieseltank reinigen', 0x41616e20646520626f76656e6b616e74207a6974206765656e206f70656e696e672074657220636f6e74726f6c652e200d0a4c696a6b74206f6620736c616e67206e616172206d6f746f72206c6f73206d6f657420766f6f72206c656567206c6174656e206c6f70656e2e, '0000-00-00', 0, 2, 0, 20, '0000-00-00 00:00:00', '2015-09-14 15:10:34', 0),
(53, 41, 'Scepterpaaltjes herzien', 0x42616b626f6f7264206d696464656c7374650d0a5374757572626f6f726420616368746572737465200d0a44656b6265766573746967696e672062616b626f6f72642061636874657273746520736365707465720d0a44656b6265766573746967696e67207374757572626f6f7264206163687465727374652073636570746572, '0000-00-00', 0, 2, 0, 20, '2002-12-02 12:19:00', '2015-11-07 15:02:37', 0),
(54, 41, 'Spinnakerval vervangen', 0x56657267656c696a6b656e206d65742067656e756176616c202832386d2920656e2032356d0d0a0d0a687474703a2f2f746f75772d737461616c6b6162656c2e6e6c2f766965775f70726f647563742e7068703f70726f647563743d76616c6c656e25323031302532306d6d2532307065722532306d6574657223, '0000-00-00', 0, 2, 0, 20, '0000-00-00 00:00:00', '2015-08-21 18:04:48', 0),
(55, 41, 'Bakboord stopper overlooprail', 0x44617420736368726f656667617420697320756974676564726161696420656e20736368726f656620697320726f65737469672e, '0000-00-00', 0, 2, 0, 20, '2015-09-03 15:51:01', '2015-09-03 15:51:01', 0),
(56, 41, 'Nattigheid hoofdeinde BB slaapplek voor', 0x4f6e64657220686574206b757373656e2077617320686574206e61742e204e6120746f6368746a65206e61617220566c69656c616e6420776172656e20626f7865727320656e20736f6b6b656e20696e206865742076616b2061616e204242206b616e74206f6f6b206e61742f766f63687469672e204c656b6b6167653f, '0000-00-00', 0, 2, 0, 20, '2015-09-14 15:06:42', '2015-09-14 15:06:42', 0),
(57, 41, 'Motor koeling issue', 0x687474703a2f2f7777772e626f617462616e7465722e636f6d2f73686f777468726561642e7068703f743d3632313038, '0000-00-00', 0, 2, 0, 20, '2015-10-14 15:24:26', '2015-10-14 15:24:26', 0),
(58, 46, 'test onderhoud', 0x74657374656e206f6620696b20646974206b616e2061616e6d616b656e, '2015-11-30', 0, 2, 0, 38, '0000-00-00 00:00:00', '2015-12-09 12:08:49', 0),
(59, 48, 'yo do', '', '2015-12-09', 0, 3, 0, 38, '2002-12-02 12:00:00', '2015-12-09 12:11:32', 0),
(60, 47, 'tetsing maintenance', 0x74657374656e206f6620646974207765726b74207a6f6e6465722064617420696b20666f7574656e206f7020646520696e64657820706167696e61206b72696a67, '2015-12-01', 0, 2, 0, 39, '0000-00-00 00:00:00', '2015-12-07 08:10:58', 0),
(61, 46, 'test', '', '2015-12-17', 0, 3, 0, 38, '2015-12-09 12:36:29', '2015-12-09 12:36:29', 0),
(62, 49, 'test', '', '2015-12-09', 0, 3, 0, 40, '2002-12-02 12:00:00', '2015-12-14 10:38:59', 1),
(63, 41, 'testing', '', '2015-12-29', 0, 1, 0, 20, '2015-12-16 12:41:03', '2015-12-16 12:41:03', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `maintenance_costs`
--

CREATE TABLE `maintenance_costs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maintenance_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `price` float NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `user_payed` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`,`maintenance_id`),
  KEY `maintenance_id` (`maintenance_id`,`created_by`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Gegevens worden geëxporteerd voor tabel `maintenance_costs`
--

INSERT INTO `maintenance_costs` (`id`, `maintenance_id`, `description`, `amount`, `price`, `type`, `user_payed`, `deleted`, `created`, `updated`, `created_by`) VALUES
(12, 17, 'Dyneema val 30 meter', 1, 50, 0, 20, 1, '0000-00-00 00:00:00', '2015-12-21 09:29:00', 38),
(13, 18, 'Dyneema val 28 meter 10mm', 1, 60, 0, 20, 0, '2015-03-16 20:46:58', '2015-05-14 12:16:45', 20),
(14, 19, '4 landvasten 12 mm 12 meter', 4, 17.5, 0, 20, 0, '2015-03-16 20:48:01', '2015-03-16 20:48:01', 20),
(15, 20, 'Havengeld', 1, 562.08, 1, 20, 0, '0000-00-00 00:00:00', '2015-08-19 15:31:01', 20),
(16, 22, 'Voorstag', 1, 94.23, 0, 20, 0, '2015-03-17 11:33:53', '2015-03-17 11:33:53', 20),
(17, 22, 'Manuren', 3, 40, 0, 20, 0, '2015-03-17 11:40:06', '2015-03-17 11:40:06', 20),
(18, 22, 'BTW 21%', 1, 44.99, 0, 20, 0, '2015-03-17 11:54:58', '2015-03-17 11:54:58', 20),
(19, 32, 'Blik lak plus kwasten en schuurpapier', 1, 40, 0, 33, 0, '2015-04-22 22:33:06', '2015-04-22 22:33:06', 33),
(20, 34, '50mm enkel blok Lewmar', 2, 18.95, 0, 20, 0, '2015-05-11 12:32:49', '2015-05-11 12:32:49', 20),
(21, 35, '36 meter sheets 8mm opgerekt poly?', 1, 72, 0, 20, 0, '2015-05-26 16:44:25', '2015-05-26 16:44:45', 20),
(22, 31, 'Nieuwe stekker voor in nieuwe radio', 1, 5, 0, 20, 0, '2015-06-15 14:02:34', '2015-06-15 14:02:34', 20),
(23, 37, 'Huik', 1, 214.88, 0, 20, 0, '2015-06-15 14:05:43', '2015-06-15 14:05:43', 20),
(24, 38, 'Gennaker 47,9 m2', 1, 619, 0, 20, 0, '2015-06-15 14:10:01', '2015-06-15 14:10:01', 20),
(25, 39, 'Checken achterlijk en nieuwe stukken erin gezet waar nodig', 1, 100, 0, 20, 0, '2015-06-25 13:57:00', '2015-06-25 13:57:00', 20),
(26, 35, 'Splitsnaald met 3x 50cm dyneema 4mm(?)', 1, 19.95, 0, 20, 0, '2015-07-05 21:43:03', '2015-07-13 13:24:52', 20),
(27, 35, '6mm dyneema 5 meter', 1, 25, 0, 20, 0, '2015-07-05 21:43:46', '2015-07-05 21:43:46', 20),
(29, 44, 'Epifanes verf', 1, 9.5, 0, 20, 0, '2015-07-25 12:26:23', '2015-07-25 12:26:23', 20),
(30, 50, 'Luidpsrekersnoer 2,5 2 meter', 2, 0.4, 0, 20, 0, '2015-08-17 08:02:46', '2015-08-17 08:02:46', 20),
(31, 50, 'kabelschoentjes', 1, 1.52, 0, 20, 0, '2015-08-17 08:03:18', '2015-08-17 08:03:18', 20),
(32, 48, 'Duits vlaggetje 20x30', 1, 4.5, 0, 20, 0, '2015-08-21 14:10:39', '2015-08-21 14:10:39', 20),
(33, 49, 'Zeiltape psp heavy duty Sail repair', 1, 17.3, 0, 20, 0, '2015-08-21 14:12:19', '2015-08-21 14:12:19', 20),
(34, 40, 'Zeilmaker Interzeil', 1, 50, 0, 20, 0, '2015-08-29 10:31:39', '2015-08-29 10:31:39', 20),
(35, 23, 'test', 5, 10, 1, 20, 0, '2015-11-30 10:44:19', '2015-11-30 10:44:19', 20),
(36, 23, 'test', 3, 3, 0, 20, 0, '2015-11-30 10:44:29', '2015-11-30 10:44:29', 20),
(37, 23, 'test', 3, 6, 0, 20, 0, '2015-11-30 10:52:39', '2015-11-30 10:52:39', 20),
(38, 23, 'yy', 2, 2, 0, 20, 0, '2015-11-30 10:52:52', '2015-11-30 10:52:52', 20),
(39, 59, 'test', 10, 10, 0, 38, 0, '2015-12-07 08:11:24', '2015-12-07 08:11:24', 39),
(42, 61, 'llll', 15, 3, 1, 38, 0, '2015-12-09 12:36:40', '2015-12-09 12:36:40', 38),
(43, 18, 'test', 12, 10, 0, 40, 1, '0000-00-00 00:00:00', '2015-12-14 10:38:59', 40),
(44, 18, 'testen', 12, 2, 0, 33, 0, '2015-12-21 12:38:57', '2015-12-21 12:38:57', 38),
(45, 18, 'testen', 12, 2, 0, 38, 0, '2015-12-21 12:38:57', '2015-12-21 12:38:57', 33),
(46, 18, '300 test', 1, 33, 1, 33, 0, '2015-12-21 12:56:02', '2015-12-21 12:56:02', 38),
(47, 59, '300 test', 10, 10, 1, 30, 0, '2015-12-21 12:56:02', '2015-12-21 12:56:02', 38),
(48, 59, '300 test', 1, 33, 1, 33, 0, '2015-12-21 12:56:02', '2015-12-21 12:56:02', 38);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `maintenance_file`
--

CREATE TABLE `maintenance_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `description` blob,
  `maintenance_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenance_id` (`maintenance_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Gegevens worden geëxporteerd voor tabel `maintenance_file`
--

INSERT INTO `maintenance_file` (`id`, `name`, `description`, `maintenance_id`, `path`, `deleted`, `created`, `updated`) VALUES
(74, '', '', 24, '24-IMG_4729-55d47ed150d0e.jpg', 0, '2015-08-19 15:04:17', '2015-08-19 15:04:17'),
(75, 'Marifoon', '', 23, '23-image-55d891b05c5dc.jpg', 0, '2015-08-22 17:13:52', '2015-08-22 17:13:52'),
(76, '', '', 55, '55-image-55e85065be515.jpg', 0, '2015-09-03 15:51:33', '2015-09-03 15:51:33'),
(77, 'Dakluik', '', 45, '45-image-563dffc53517c.jpg', 0, '2015-11-07 14:42:29', '2015-11-07 14:42:29'),
(78, '', '', 45, '45-image-563dfff084809.jpg', 0, '2015-11-07 14:43:12', '2015-11-07 14:43:12'),
(79, '', '', 53, '53-IMG_5774-563e20349e2d5.jpg', 0, '2015-11-07 17:00:52', '2015-11-07 17:00:52'),
(80, '', '', 53, '53-IMG_5775-563e2057c2e7a.jpg', 0, '2015-11-07 17:01:27', '2015-11-07 17:01:27'),
(81, '', '', 53, '53-IMG_5776-563e206562ec8.jpg', 0, '2015-11-07 17:01:41', '2015-11-07 17:01:41'),
(82, '', '', 23, '23-landscape_fantasy_by_angoria-d6uk3so-565c29407f6e0.jpg', 0, '2015-11-30 10:47:28', '2015-11-30 10:47:28'),
(83, 'test image', 0x65656e206f6d736368696a76696e67, 23, '23-Screenshot from 2015-05-07 14:42:34-565c29978af89.png', 0, '2015-11-30 10:48:55', '2015-11-30 10:48:55'),
(84, '', '', 23, '23-Screenshot from 2015-05-07 14:42:34-565c2ab75760c.png', 0, '2015-11-30 10:53:43', '2015-11-30 10:53:43'),
(85, '', '', 23, '23-Screenshot from 2015-01-22 12:47:24-565c2ac5b5217.png', 0, '2015-11-30 10:53:57', '2015-11-30 10:53:57');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1417795993),
('m130524_201442_init', 1417795995),
('m140506_102106_rbac_init', 1418727650);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sailor`
--

CREATE TABLE `sailor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `country` (`country`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Gegevens worden geëxporteerd voor tabel `sailor`
--

INSERT INTO `sailor` (`id`, `first_name`, `last_name`, `city`, `country`, `birth_date`, `deleted`, `user_id`, `created`, `updated`) VALUES
(9, 'Teun', 'Bakker', '', NULL, '0000-00-00', 0, 20, '2015-03-16 20:37:54', '2015-03-16 20:37:54'),
(19, 'Frans', 'Pot', 'Lauwersoog', 1, '1949-04-02', 0, 30, '2015-03-23 12:34:40', '2015-03-23 12:34:40'),
(20, 'Geertjan', 'Woudsma', 'Utrecht', 1, '1986-02-15', 0, 31, '2015-03-29 18:11:35', '2015-03-29 18:11:35'),
(21, 'Test', 'Niels', 'groningen', 1, '1986-02-06', 0, 32, '2015-04-11 20:42:36', '2015-04-11 20:42:36'),
(22, 'Lieuwe', 'de Vries', 'Groningen', 1, '1986-10-10', 0, 33, '2015-04-22 22:30:53', '2015-04-22 22:30:53'),
(23, 'Teun', 'Bakker', 'Groningen', 1, '1986-02-06', 0, 34, '2015-07-22 13:59:12', '2015-07-22 13:59:12'),
(24, 'Test', 'Releaz', 'Groningen', 1, '1986-02-06', 0, 37, '2015-11-05 11:09:04', '2015-11-05 11:09:04'),
(25, 'Reinier test voornaam', 'de la Parra', 'Groningen', 1, '1992-12-01', 0, 38, '2002-12-02 12:19:00', '2015-12-22 12:38:33'),
(26, 'Reinier', 'Test', 'Groningen', 1, '2015-12-01', 0, 39, '2015-12-07 08:07:57', '2015-12-07 08:07:57'),
(27, 'Reinier', 'de la Parra', 'Groningen', 1, '1986-02-28', 0, 40, '2015-12-14 10:30:06', '2015-12-14 10:30:06'),
(32, 'Reinier', 'de la Parra', 'Groningen', 1, '1992-12-01', 0, 45, '2002-12-02 12:19:00', '2015-12-23 09:04:13'),
(33, 'Test', 'Dummy', 'Groningen', 1, '1986-02-12', 0, 47, '2015-12-23 09:10:44', '2015-12-23 09:10:44');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT '10',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=48 ;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'hrwaysem99KmmPUPCiTYmo5Lrn_9ljHp', '$2y$13$z.NVmfPL44rC8FOavvhnEeC6esWcV3JDzaWA5XiGQ6nXRfdeuz.Oy', NULL, 'admin@releaz.nl', 10, 10, 0, 1417796024, 1417796024),
(20, 'teun.bakker@gmail.com', 'vg48AeVddfWh_hqHzFk8v4WvMq4IX_ng', '$2y$13$JdQmhsD9IjLS3nWkiw4i.OFiyDqD9TC9ygaNa/Rpca/t6NAJsCnr6', NULL, 'teun.bakker@gmail.com', 10, 10, 0, 1426534674, 1446478105),
(30, 'frans@delauwer.nl', '1fXL-O2bYqQICgFhw2Sr-BEyEawU6fmD', '$2y$13$TozxZei99zX8P5wdIVbEAODsM5U14ORVf/i1DbzWHw4Ox.IeuHnWW', NULL, 'frans@delauwer.nl', 10, 10, 0, 1427110480, 1427110480),
(31, 'G.woudsma@gmail.com', 'TusdTcZSLfpXT8QpBYGjzuLATzvIEcYD', '$2y$13$//h0xEJgKjnbkT.XARdRt.WBThTK1gkv55qmIjWINx3Fxu3/XKXEW', '1wjsBxxULdwUp2khxKmV741aS2Yuboeu_1438062474', 'G.woudsma@gmail.com', 10, 10, 0, 1427645495, 1438062475),
(32, 'niels@test.nl', 'l24FI5WA6gzryZQ1ETbtNCt9MF_v6KbW', '$2y$13$cL8gHmWNbQP33jUpZAtSzu7ADUxZKY0hYoMasvlIMUtpylwtYvz96', NULL, 'niels@test.nl', 10, 10, 0, 1428777756, 1428777756),
(33, 'lieuwe17@gmail.com', 'FoD8xgvhTUcs-ZNWsAI5jJOYvgkCJjp8', '$2y$13$0ammtdJ7hit8asDdShLZWOfPwgNjmZx8ROUNa2w8yQ9FXiffHYjG.', NULL, 'lieuwe17@gmail.com', 10, 10, 0, 1429734653, 1429734653),
(34, 'teun@releaz.nl', 'iafSI91D29FhEI9cljgRTH8ZJdxgtcK4', '$2y$13$WppZJKTEWptfPaUNnmAII.52nxXq.XrBCtbIRBTg5y.xCc.jLrxXa', NULL, 'teun@releaz.nl', 10, 10, 0, 1437566352, 1437566352),
(36, 'reinier@releaz.nl', 'iLbDMK64lmylFdLFDcEYGIFc4zgLyYaD', '$2y$13$.8SQ0.1JPRjsMIJRNp.WDuErE3ig1z/kQEY7bA6LfkIXmDd9YgzHC', NULL, 'reinier@releaz.nl', 10, 10, 0, 1446559160, 1446559160),
(37, 'test@releaz.nl', 'C1GcRwsVOZ9mJnJpRxIl59peu66pYUg3', '$2y$13$yLKVRGRJpb6LsQkTOkLmAOTn7fd5CeK8E7oPLOYMIzpiyCcwpoEUS', NULL, 'test@releaz.nl', 10, 10, 0, 1446718143, 1446718143),
(38, 'reinierdlp@gmail.releaz', 'b1D0LPqjWpmlNZmL1H3DY5Lp5jR-xGFk', '$2y$13$L3fTpVGtcQFzXduQArkX3u3suQCCp0VKMHkHDluvUpQj3.u29QnVa', NULL, 'reinierdlp@gmail.releaz', 10, 10, 0, 1448874052, 1450784313),
(39, 'reinier@test.nl', 'UENPVt6Ae5AVI4HD27rhHQkVLE37BuqK', '$2y$13$LPZB3tB/UVHfxntVv6de3e6V7hAfdOujkLm.ErGrYZp5HfME0JkFC', NULL, 'reinier@test.nl', 10, 10, 0, 1449475677, 1449475677),
(40, 'reinier@test.test', 'snb3n6xrdviKLOLcnpeVlCX0ayb7LRr0', '$2y$13$G/6RiJ9RgZrrDb9FaCLBduubQ4wXfefu18n0uM5IaVsNcxV245Z2u', NULL, 'reinier@test.test', 10, 10, 0, 1450089006, 1450089006),
(45, 'reinierdlp@live.nl', 'i0yOUtaSxYAvtkdDBqxv_ub2GFCh1c1D', '$2y$13$dAOhYI0a1omNkQExfGG.XOT4eOzlKXb0s2uy3bHSQw7y1b2/LuMD.', NULL, 'reinierdlp@live.nl', 10, 10, 0, 1450857356, 1450857853),
(47, 'reinierdlp@gmail.com', 'INhqytlbqbuZIYEGBodr2GKq0H6ZkxIH', '$2y$13$GaIJfBEbfGbd26OI6l165.5O2eyCgh7ubwd6h7aKWW9iIYfh.JAgu', NULL, 'reinierdlp@gmail.com', 10, 10, 0, 1450858203, 1450858244);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `yacht`
--

CREATE TABLE `yacht` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sail_number` varchar(10) DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `year_build` int(4) DEFAULT NULL,
  `callsign` varchar(6) DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `length` double DEFAULT NULL,
  `width` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `depth` double DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`),
  KEY `brand_id` (`model_id`),
  KEY `model_id` (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Gegevens worden geëxporteerd voor tabel `yacht`
--

INSERT INTO `yacht` (`id`, `model_id`, `name`, `sail_number`, `owner`, `year_build`, `callsign`, `type`, `created`, `length`, `width`, `height`, `depth`, `weight`, `deleted`) VALUES
(41, 1, 'Seedling', NULL, 20, 1984, 'PA6371', 0, '2015-03-16 20:45:25', 8.42, 2.99, NULL, 1.25, 3100, 0),
(42, 8, 'Fortura', NULL, 31, 1979, '', 0, '2015-03-29 18:12:45', NULL, NULL, NULL, NULL, NULL, 0),
(43, 15, 'NK40', NULL, 33, 2008, '', 0, '2015-04-22 22:31:30', NULL, NULL, NULL, NULL, NULL, 0),
(44, 16, 'Kapertje', NULL, 33, 2003, '', 0, '2015-04-22 22:36:44', NULL, NULL, NULL, NULL, NULL, 0),
(45, 17, 'Geen', NULL, 34, 2015, 'PF8940', 0, '2015-07-22 14:00:41', 12, 3, NULL, 0.8, 6500, 0),
(46, 1, 'Reinier', '', 38, NULL, '', 0, '2015-11-30 09:18:17', NULL, NULL, NULL, NULL, NULL, 0),
(47, 18, 'test van reinier', '', 39, NULL, '', 0, '2015-12-07 08:10:18', NULL, NULL, NULL, NULL, NULL, 0),
(48, 8, 'tweede yacht om te testen', '', 38, NULL, '', 1, '2015-12-09 12:10:41', NULL, NULL, NULL, NULL, NULL, 0),
(49, 18, 'test', '', 40, NULL, '', 0, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `yacht_brand`
--

CREATE TABLE `yacht_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Gegevens worden geëxporteerd voor tabel `yacht_brand`
--

INSERT INTO `yacht_brand` (`id`, `name`, `image`, `url`, `deleted`) VALUES
(1, 'Etap', 'none', 'www.etapyachts.com', 0),
(2, 'Dehler', 'dehler.jpg', 'www.dehler.com', 0),
(3, 'Victoire', '', '', 0),
(4, 'Beneteau', '', '', 0),
(5, 'Elan', '', '', 0),
(6, 'J-Boats', '', '', 0),
(7, 'Dufour', '', '', 0),
(8, 'Salona', '', '', 0),
(9, 'Noordkaper', '', '', 0),
(10, 'Randmeer', '', '', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `yacht_model`
--

CREATE TABLE `yacht_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Gegevens worden geëxporteerd voor tabel `yacht_model`
--

INSERT INTO `yacht_model` (`id`, `brand_id`, `name`, `deleted`) VALUES
(1, 1, '28', 0),
(2, 2, '28S', 0),
(3, 3, '10.44', 0),
(4, 3, '9.33', 0),
(5, 4, 'First 31.7', 0),
(6, 5, '350', 0),
(7, 4, 'First 21.7', 0),
(8, 4, 'First 27', 0),
(10, 4, 'First 24.7', 0),
(14, 6, 'J122', 0),
(15, 9, '40 visserman flushdeck', 0),
(16, 10, 'Advance', 0),
(17, 9, '42', 0),
(18, 1, 'nioi', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `yacht_owner`
--

CREATE TABLE `yacht_owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `yacht_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `key` varchar(128) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `datetime_created` datetime NOT NULL,
  `datetime_updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `yacht_id` (`yacht_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Gegevens worden geëxporteerd voor tabel `yacht_owner`
--

INSERT INTO `yacht_owner` (`id`, `user_id`, `yacht_id`, `active`, `key`, `deleted`, `datetime_created`, `datetime_updated`) VALUES
(1, 38, 41, 1, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 30, 48, 0, 'MQvl9hXQX35QD-wyvUn5HvyOXR04RRXC', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 33, 48, 1, 'null', 0, '2015-12-22 09:09:07', '2015-12-22 09:09:12');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `handicap_yacht`
--
ALTER TABLE `handicap_yacht`
  ADD CONSTRAINT `handicap_yacht_ibfk_1` FOREIGN KEY (`handicap_id`) REFERENCES `handicap` (`id`),
  ADD CONSTRAINT `handicap_yacht_ibfk_2` FOREIGN KEY (`yacht_id`) REFERENCES `yacht` (`id`);

--
-- Beperkingen voor tabel `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`yacht_id`) REFERENCES `yacht` (`id`),
  ADD CONSTRAINT `maintenance_ibfk_2` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `maintenance_costs`
--
ALTER TABLE `maintenance_costs`
  ADD CONSTRAINT `maintenance_costs_ibfk_1` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenance` (`id`),
  ADD CONSTRAINT `maintenance_costs_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `maintenance_file`
--
ALTER TABLE `maintenance_file`
  ADD CONSTRAINT `maintenance_file_ibfk_1` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenance` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `sailor`
--
ALTER TABLE `sailor`
  ADD CONSTRAINT `sailor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `sailor_ibfk_2` FOREIGN KEY (`country`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `yacht`
--
ALTER TABLE `yacht`
  ADD CONSTRAINT `yacht_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `yacht_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `yacht_model` (`id`);

--
-- Beperkingen voor tabel `yacht_model`
--
ALTER TABLE `yacht_model`
  ADD CONSTRAINT `yacht_model_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `yacht_brand` (`id`);

--
-- Beperkingen voor tabel `yacht_owner`
--
ALTER TABLE `yacht_owner`
  ADD CONSTRAINT `yacht_owner_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `yacht_owner_ibfk_2` FOREIGN KEY (`yacht_id`) REFERENCES `yacht` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
