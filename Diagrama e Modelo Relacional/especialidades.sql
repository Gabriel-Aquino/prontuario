use mydb;

CREATE TABLE esp_med(
   crm_med int not null,
   id_esp int not null,
   nome VARCHAR(40),
   foreign key(crm_med) references Medico(CRM) ON DELETE CASCADE ON UPDATE CASCADE,
   foreign key(id_esp) references especialidades(id) ON DELETE CASCADE ON UPDATE CASCADE
);
drop table esp_med;
select * from esp_med;
select * from especialidades;
CREATE TABLE especialidades(
   id int not null,
   nome VARCHAR(40),
   PRIMARY KEY(id)
);

INSERT INTO `especialidades` (`id`, `nome`) VALUES
(3, 'Acupuntura'),
(4, 'Alergia e Imunologia'),
(5, 'Anestesiologia'),
(6, 'Angiologia'),
(7, 'Cancerologia'),
(8, 'Cardiologia'),
(9, 'Cirurgia Cardiovascular'),
(10, 'Cirurgia da Mão'),
(11, 'Cirurgia de cabeça e pescoço'),
(12, 'Cirurgia do Aparelho Digestivo'),
(13, 'Cirurgia Pediátrica'),
(14, 'Cirurgia Plástica'),
(15, 'Cirurgia Torácica'),
(16, 'Cirurgia Vascular'),
(17, 'Clínica Médica'),
(18, 'Coloproctologia'),
(19, 'Dermatologia'),
(20, 'Endocrinologia e Metabologia'),
(21, 'Endoscopia'),
(22, 'Gastroenterologia'),
(23, 'Genética médica'),
(24, 'Geriatria'),
(25, 'Ginecologia e obstetrícia'),
(26, 'Hematologia e Hemoterapia'),
(27, 'Homeopatia'),
(28, 'Infectologia'),
(29, 'Mastologia'),
(30, 'Medicina de Família e Comunidade'),
(31, 'Medicina do Trabalho'),
(32, 'Medicina do Tráfego'),
(33, 'Medicina Esportiva'),
(34, 'Medicina Física e Reabilitação'),
(35, 'Medicina Intensiva'),
(36, 'Medicina Legal e Perícia Médica'),
(37, 'Medicina Nuclear'),
(38, 'Medicina Preventiva e Social'),
(39, 'Nefrologia'),
(40, 'Neurocirurgia'),
(41, 'Neurologia'),
(42, 'Obstetrícia'),
(43, 'Oftalmologia'),
(44, 'Ortopedia e Traumatologia'),
(45, 'Otorrinolaringologia'),
(46, 'Patologia'),
(47, 'Patologia Clínica/Medicina laboratorial'),
(48, 'Pediatria'),
(49, 'Pneumologia'),
(50, 'Psiquiatria'),
(51, 'Radiologia'),
(52, 'Radioterapia'),
(53, 'Reumatologia'),
(54, 'Urologia');