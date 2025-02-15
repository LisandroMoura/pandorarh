CREATE TABLE `funcionarios` (
  `id` id PRIMARY KEY,
  `nome_completo` varchar(191) NOT NULL,
  `apelido` varchar(191),
  `cfp` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL,
  `genero` ENUM ('Não informado', 'Masculino', 'Feminino') DEFAULT 'Não informado',
  `estado_civil` varchar(255) DEFAULT 'Solteiro',
  `telefone` VARCHAR(20),
  `nome_pai_mae` varchar(255),
  `email` VARCHAR(150) UNIQUE,
  `status` ENUM ('Ativo', 'Inativo') DEFAULT 'Ativo',
  `cargo_id` bigint,
  `endereco` TEXT NOT NULL,
  `cep` CHAR(8),
  `cidade` VARCHAR(100),
  `estado` CHAR(2),
  `departamento` VARCHAR(100),
  `data_admissao` DATE NOT NULL,
  `tipo_contrato` ENUM ('CLT', 'PJ', 'Estágio', 'Autônomo', 'Temporário') NOT NULL DEFAULT 'CLT',
  `salario` DECIMAL(10,2) NOT NULL,
  `banco` VARCHAR(100),
  `agencia` VARCHAR(10),
  `conta` VARCHAR(20),
  `pis` CHAR(11) UNIQUE,
  `ctps` VARCHAR(20) UNIQUE,
  `data_rescisao` DATE DEFAULT null,
  `motivo_rescisao` TEXT DEFAULT null
);

CREATE TABLE `cargo` (
  `id` integer PRIMARY KEY,
  `nome` varchar(100) NOT NULL,
  `descricao` text COMMENT 'descrição do cargo',
  `status` varchar(255)
);

ALTER TABLE `funcionarios` ADD FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`id`);
