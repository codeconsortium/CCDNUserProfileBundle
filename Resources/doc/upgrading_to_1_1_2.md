Upgrading CCDNUser ProfileBundle to 1.1.2
=========================================

Run this SQL to upgrade.

```sql
set foreign_key_checks=0;

ALTER TABLE CC_User_Profile DROP FOREIGN KEY FK_6A74B283A76ED395;
DROP INDEX UNIQ_6A74B283A76ED395 ON CC_User_Profile;
ALTER TABLE CC_User_Profile 
	CHANGE user_id fk_user_id INT DEFAULT NULL;
ALTER TABLE CC_User_Profile ADD CONSTRAINT FK_6A74B2835741EEB9 FOREIGN KEY (fk_user_id) REFERENCES fos_user(id) ON DELETE SET NULL;
CREATE UNIQUE INDEX UNIQ_6A74B2835741EEB9 ON CC_User_Profile (fk_user_id);

set foreign_key_checks=1;
```

- [Return back to the docs index](index.md).
