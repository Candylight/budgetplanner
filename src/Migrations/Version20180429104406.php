<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180429104406 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE budget (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE budget_goal (budget_id INT NOT NULL, goal_id INT NOT NULL, INDEX IDX_8618E97E36ABA6B8 (budget_id), INDEX IDX_8618E97E667D1AFE (goal_id), PRIMARY KEY(budget_id, goal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE budget_expense (budget_id INT NOT NULL, expense_id INT NOT NULL, INDEX IDX_EFB9C74736ABA6B8 (budget_id), INDEX IDX_EFB9C747F395DB7B (expense_id), PRIMARY KEY(budget_id, expense_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE budget_income (budget_id INT NOT NULL, income_id INT NOT NULL, INDEX IDX_6B1D246C36ABA6B8 (budget_id), INDEX IDX_6B1D246C640ED2C0 (income_id), PRIMARY KEY(budget_id, income_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE budget_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, is_recurrent TINYINT(1) NOT NULL, date DATETIME NOT NULL, recurring_date DATETIME DEFAULT NULL, priority INT DEFAULT NULL, INDEX IDX_2D3A8DA612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE income (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, is_recurrent TINYINT(1) NOT NULL, date DATETIME NOT NULL, recurring_date DATETIME DEFAULT NULL, INDEX IDX_3FA862D012469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE budget_goal ADD CONSTRAINT FK_8618E97E36ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE budget_goal ADD CONSTRAINT FK_8618E97E667D1AFE FOREIGN KEY (goal_id) REFERENCES goal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE budget_expense ADD CONSTRAINT FK_EFB9C74736ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE budget_expense ADD CONSTRAINT FK_EFB9C747F395DB7B FOREIGN KEY (expense_id) REFERENCES expense (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE budget_income ADD CONSTRAINT FK_6B1D246C36ABA6B8 FOREIGN KEY (budget_id) REFERENCES budget (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE budget_income ADD CONSTRAINT FK_6B1D246C640ED2C0 FOREIGN KEY (income_id) REFERENCES income (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA612469DE2 FOREIGN KEY (category_id) REFERENCES budget_category (id)');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D012469DE2 FOREIGN KEY (category_id) REFERENCES budget_category (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE budget_goal DROP FOREIGN KEY FK_8618E97E36ABA6B8');
        $this->addSql('ALTER TABLE budget_expense DROP FOREIGN KEY FK_EFB9C74736ABA6B8');
        $this->addSql('ALTER TABLE budget_income DROP FOREIGN KEY FK_6B1D246C36ABA6B8');
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA612469DE2');
        $this->addSql('ALTER TABLE income DROP FOREIGN KEY FK_3FA862D012469DE2');
        $this->addSql('ALTER TABLE budget_expense DROP FOREIGN KEY FK_EFB9C747F395DB7B');
        $this->addSql('ALTER TABLE budget_income DROP FOREIGN KEY FK_6B1D246C640ED2C0');
        $this->addSql('DROP TABLE budget');
        $this->addSql('DROP TABLE budget_goal');
        $this->addSql('DROP TABLE budget_expense');
        $this->addSql('DROP TABLE budget_income');
        $this->addSql('DROP TABLE budget_category');
        $this->addSql('DROP TABLE expense');
        $this->addSql('DROP TABLE income');
    }
}
