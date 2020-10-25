## BeeJee Tasks App (MVC)

```bash
git clone git@github.com:farukh-narzullaev/beejee-tasks-app.git
```

```bash
$ cd beejee-tasks-app

# No packages are used, just need for autoloading
$ composer install 
```

```sql
CREATE DATABASE `tasks_app`;

CREATE TABLE `tasks` ( 
    `id` INT NOT NULL AUTO_INCREMENT, 
    `name` VARCHAR(255) NOT NULL, 
    `email` VARCHAR(255) NOT NULL, 
    `text` TEXT NOT NULL, 
    `status` BOOLEAN NOT NULL, 
    `is_edited_by_admin` BOOLEAN NOT NULL, 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `users` ( 
    `id` INT NOT NULL AUTO_INCREMENT, 
    `username` VARCHAR(255) NOT NULL, 
    `password` VARCHAR(255) NOT NULL, 
    PRIMARY KEY (`id`), 
    UNIQUE `username` (`username`)
) ENGINE = InnoDB;
```

```sql
--- Add an admin
INSERT INTO `users`( 
    `username`, 
    `password`
) 
VALUES (
    'admin', 
    '$2y$10$zcenPcptexXLQcxGo7UNOeK11iHIWe3bbJj43Ta5JjQBSPchiMXp.'
);
```

Open ```config/database.php``` and change database configuration settings.
