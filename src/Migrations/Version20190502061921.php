<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 * @codingStandardsIgnoreFile
 */
final class Version20190502061921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, application_deadline DATETIME NOT NULL, final_deadline DATETIME NOT NULL, status INT NOT NULL, owner INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_technology (activity_id INT NOT NULL, technology_id INT NOT NULL, INDEX IDX_A1816C4581C06096 (activity_id), INDEX IDX_A1816C454235D463 (technology_id), PRIMARY KEY(activity_id, technology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity_type (activity_id INT NOT NULL, type_id INT NOT NULL, INDEX IDX_8F1A8CBB81C06096 (activity_id), INDEX IDX_8F1A8CBBC54C8C93 (type_id), PRIMARY KEY(activity_id, type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technology (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, version VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, seniority INT NOT NULL, name VARCHAR(255) NOT NULL, surname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_technology (user_id INT NOT NULL, technology_id INT NOT NULL, INDEX IDX_530494A1A76ED395 (user_id), INDEX IDX_530494A14235D463 (technology_id), PRIMARY KEY(user_id, technology_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity_technology ADD CONSTRAINT FK_A1816C4581C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_technology ADD CONSTRAINT FK_A1816C454235D463 FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_type ADD CONSTRAINT FK_8F1A8CBB81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity_type ADD CONSTRAINT FK_8F1A8CBBC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_technology ADD CONSTRAINT FK_530494A1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_technology ADD CONSTRAINT FK_530494A14235D463 FOREIGN KEY (technology_id) REFERENCES technology (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('ALTER TABLE activity_technology DROP FOREIGN KEY FK_A1816C4581C06096');
        $this->addSql('ALTER TABLE activity_type DROP FOREIGN KEY FK_8F1A8CBB81C06096');
        $this->addSql('ALTER TABLE activity_type DROP FOREIGN KEY FK_8F1A8CBBC54C8C93');
        $this->addSql('ALTER TABLE activity_technology DROP FOREIGN KEY FK_A1816C454235D463');
        $this->addSql('ALTER TABLE user_technology DROP FOREIGN KEY FK_530494A14235D463');
        $this->addSql('ALTER TABLE user_technology DROP FOREIGN KEY FK_530494A1A76ED395');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE activity_technology');
        $this->addSql('DROP TABLE activity_type');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE technology');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_technology');
    }
}
