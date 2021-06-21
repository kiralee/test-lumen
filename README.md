# Test Lumen With Docker
## Introduce
Testing lumen with docker composer
## Technology
- Nginx
- PHP8.0.6
- Mysql Server
- Composer 2.0
## How to use

* Run command to start project
``` 
sh start.sh 
```
- Access site with url http://127.0.0.1:8888

## Structure of tables
### Wagers
```
  +-----------------------+-----------------------+------+-----+-------------------+-----------------------------+
  | Field                 | Type                  | Null | Key | Default           | Extra                       |
  +-----------------------+-----------------------+------+-----+-------------------+-----------------------------+
  | id                    | bigint(20) unsigned   | NO   | PRI | NULL              | auto_increment              |
  | total_wager_value     | int(10) unsigned      | NO   |     | NULL              |                             |
  | odds                  | int(10) unsigned      | NO   |     | NULL              |                             |
  | selling_percentage    | int(10) unsigned      | NO   |     | NULL              |                             |
  | selling_price         | decimal(8,2) unsigned | NO   |     | NULL              |                             |
  | current_selling_price | decimal(8,2) unsigned | YES  |     | NULL              |                             |
  | percentage_sold       | int(10) unsigned      | YES  |     | NULL              |                             |
  | amount_sold           | decimal(8,2)          | YES  |     | NULL              |                             |
  | placed_at             | timestamp             | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
  | created_at            | timestamp             | YES  |     | NULL              |                             |
  | updated_at            | timestamp             | YES  |     | NULL              |                             |
  +-----------------------+-----------------------+------+-----+-------------------+-----------------------------+
```
### Orders
```
+--------------+-----------------------+------+-----+-------------------+-----------------------------+
| Field        | Type                  | Null | Key | Default           | Extra                       |
+--------------+-----------------------+------+-----+-------------------+-----------------------------+
| id           | bigint(20) unsigned   | NO   | PRI | NULL              | auto_increment              |
| wager_id     | bigint(20) unsigned   | NO   | MUL | NULL              |                             |
| buying_price | decimal(8,2) unsigned | NO   |     | NULL              |                             |
| bought_at    | timestamp             | NO   |     | CURRENT_TIMESTAMP | on update CURRENT_TIMESTAMP |
| created_at   | timestamp             | YES  |     | NULL              |                             |
| updated_at   | timestamp             | YES  |     | NULL              |                             |
+--------------+-----------------------+------+-----+-------------------+-----------------------------+
```