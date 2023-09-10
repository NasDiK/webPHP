const { getBaseKnexConfig, getPGKnex } = require("../utils");

const config = getBaseKnexConfig();
const knex = getPGKnex(config);

const down = async() => {
  const LIBRARY_DB_NAME = 'L_11_library'
  const RENT_DB_NAME = 'L_11_rent'
  const AVIA_DB_NAME = 'L_11_aviaTickets'

  await Promise.all([
    knex.raw(`SELECT pg_terminate_backend(pg_stat_activity.pid) FROM pg_stat_activity 
    WHERE pg_stat_activity.datname = '${LIBRARY_DB_NAME}' AND pid <> pg_backend_pid()`),
    knex.raw(`SELECT pg_terminate_backend(pg_stat_activity.pid) FROM pg_stat_activity 
    WHERE pg_stat_activity.datname = '${RENT_DB_NAME}' AND pid <> pg_backend_pid()`),
    knex.raw(`SELECT pg_terminate_backend(pg_stat_activity.pid) FROM pg_stat_activity 
    WHERE pg_stat_activity.datname = '${AVIA_DB_NAME}' AND pid <> pg_backend_pid()`)
  ])

  await Promise.all([
    knex.raw(`DROP DATABASE "${LIBRARY_DB_NAME}"`),
    knex.raw(`DROP DATABASE "${RENT_DB_NAME}"`),
    knex.raw(`DROP DATABASE "${AVIA_DB_NAME}"`)
  ]);

  console.log('Done');
};

const destroyDB = () => {
  knex.destroy();
}

down().then(destroyDB);
