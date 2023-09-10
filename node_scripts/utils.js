const knex = require('knex');

const getBaseKnexConfig = (dbName, user = 'postgres', password = 'root') => ({
    client: 'pg',
    connection: {
      database: dbName,
      user,
      password,
      host: 'localhost'
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      directory: 'migrations',
      tableName: 'knex_migrations'
    }
});

/**
 * @returns {import('knex').Knex} 
 */
const getPGKnex = (config) => knex(config);

module.exports = {
  getBaseKnexConfig,
  getPGKnex
}