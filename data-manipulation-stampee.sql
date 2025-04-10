USE mvc_stampee;

SELECT * from color; 

-- Insertar data para pais de origen
INSERT INTO `mvc_stampee`.`country` (`id`, `name`) VALUES
('1', 'France'),
('2', 'United States'),
('3', 'Germany'),
('4', 'United Kingdom'),
('5', 'Italy'),
('6', 'Spain'),
('7', 'Japan'),
('8', 'China'),
('9', 'Canada'),
('10', 'Russia'),
('11', 'Australia'),
('12', 'Brazil'),
('13', 'Switzerland'),
('14', 'Netherlands'),
('15', 'Belgium'),
('16', 'Sweden'),
('17', 'Norway'),
('18', 'Denmark'),
('19', 'Portugal'),
('20', 'Austria'),
('21', 'Mexico'),
('22', 'India'),
('23', 'South Korea'),
('24', 'Argentina'),
('25', 'Poland'),
('26', 'South Africa'),
('27', 'Czech Republic'),
('28', 'Hungary'),
('29', 'Greece'),
('30', 'Thailand'),
('31', 'Finland'),
('32', 'New Zealand'),
('33', 'Indonesia'),
('34', 'Turkey'),
('35', 'Ireland'),
('36', 'Vatican City'),
('37', 'Luxembourg'),
('38', 'Monaco'),
('39', 'Liechtenstein'),
('40', 'San Marino'),
('41', 'Romania'),
('42', 'Ukraine'),
('43', 'Chile'),
('44', 'Colombia'),
('45', 'Peru'),
('46', 'Malaysia'),
('47', 'Philippines'),
('48', 'Singapore'),
('49', 'Vietnam'),
('50', 'Hong Kong'),
('51', 'Taiwan'),
('52', 'Iceland'),
('53', 'Slovakia'),
('54', 'Slovenia'),
('55', 'Estonia'),
('56', 'Latvia'),
('57', 'Lithuania'),
('58', 'Belarus'),
('59', 'Bulgaria'),
('60', 'Serbia'),
('61', 'Croatia'),
('62', 'Bosnia and Herzegovina'),
('63', 'Montenegro'),
('64', 'Moldova'),
('65', 'Kazakhstan'),
('66', 'Georgia'),
('67', 'Armenia'),
('68', 'Azerbaijan'),
('69', 'Uruguay'),
('70', 'Ecuador'),
('71', 'Paraguay'),
('72', 'Bolivia'),
('73', 'Costa Rica'),
('74', 'Panama'),
('75', 'Cuba'),
('76', 'Dominican Republic'),
('77', 'El Salvador'),
('78', 'Guatemala'),
('79', 'Honduras'),
('80', 'Nicaragua'),
('81', 'Venezuela'),
('82', 'Lebanon'),
('83', 'Jordan'),
('84', 'Israel'),
('85', 'Egypt'),
('86', 'Tunisia'),
('87', 'Algeria'),
('88', 'Morocco'),
('89', 'Saudi Arabia'),
('90', 'United Arab Emirates'),
('91', 'Qatar'),
('92', 'Bahrain'),
('93', 'Oman'),
('94', 'Kuwait'),
('95', 'Pakistan'),
('96', 'Bangladesh'),
('97', 'Sri Lanka'),
('98', 'Nepal'),
('99', 'Myanmar'),
('100', 'Cyprus');

-- Insertar los colores
INSERT INTO mvc_stampee.color (id, name) VALUES
('1', 'Rouge'),
('2', 'Bleu'),
('3', 'Vert'),
('4', 'Jaune'),
('5', 'Noir'),
('6', 'Blanc'),
('7', 'Orange'),
('8', 'Violet'),
('9', 'Marron'),
('10', 'Gris'),
('11', 'Rose'),
('12', 'Cyan'),
('13', 'Magenta'),
('14', 'Turquoise'),
('15', 'Lavande'),
('16', 'Beige'),
('17', 'Bordeaux'),
('18', 'Olive'),
('19', 'Bleu Marine'),
('20', 'Sarcelle'),
('21', 'Or'),
('22', 'Argent'),
('23', 'Bronze'),
('24', 'Indigo'),
('25', 'Violet Foncé'),
('26', 'Corail'),
('27', 'Saumon'),
('28', 'Cramoisi'),
('29', 'Charbon'),
('30', 'Perle'),
('31', 'Ivoire'),
('32', 'Émeraude'),
('33', 'Saphir'),
('34', 'Rubis'),
('35', 'Améthyste'),
('36', 'Aigue-marine'),
('37', 'Ambre'),
('38', 'Topaze'),
('39', 'Vert Menthe'),
('40', 'Chartreuse'),
('41', 'Pervenche'),
('42', 'Rose Pâle'),
('43', 'Bourgogne'),
('44', 'Mauve'),
('45', 'Moutarde'),
('46', 'Sable'),
('47', 'Cuivre'),
('48', 'Azur'),
('49', 'Vert Citron'),
('50', 'Bleu Denim');

-- Insertar los Thématique
INSERT INTO mvc_stampee.theme (id, name) VALUES
('1', 'Géographie et Tourisme'),
('2', 'Géographie et Tourisme'),
('3', 'Animaux'),
('4', 'Arts et artisanats'),
('5', 'Flore et ecologie'),
('6', 'Sports'),
('7', 'Transports et aérospatiale');

-- Insertar los Condition
INSERT INTO mvc_stampee.stamp_condition (id, name) VALUES
('1', 'Parfaite'),
('2', 'Excellente'),
('3', 'Bonne'),
('4', 'Moyenne'),
('5', 'Endommagé');

SELECT * FROM theme;
SELECT * FROM stamp_condition;
SELECT * FROM image_to_upload;

UPDATE mvc_stampee.theme
SET name = 'Personnages célèbres'
WHERE id = 2;

-- Table Bid
SELECT *
FROM bid
WHERE auction_id = 1
  AND bid_amount = (
    SELECT MAX(bid_amount)
    FROM bid
    WHERE auction_id = 1
);
SELECT * FROM state;

INSERT INTO state (name) VALUES ('Active');
INSERT INTO state (name) VALUES ('Finished');
INSERT INTO state (name) VALUES ('Pending');

