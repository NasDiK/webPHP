const { getBaseKnexConfig, getPGKnex } = require("../utils");

const config = getBaseKnexConfig();
const knex = getPGKnex(config);

const dataToInsert = {
  library: {
    books: [
      {
        title: 'Золотая рыбка',
        authorName: 'Пушкин А. С.'
      },
      {
        title: 'Малыш и Карлсон',
        authorName: 'Астрит Линдгрен'
      },
      {
        title: 'Сказка о царе Салтане',
        authorName: 'Пушкин А. С.'
      },
      {
        title: 'Русалочка',
        authorName: 'Ханс Кристиан Андерсен'
      },
      {
        title: 'Красная шапочка'
      },
    ],
    clients: [
      {surname: 'Тунгусов'},
      {surname: 'Петров'},
      {surname: 'Сидоров'},
      {surname: 'Ванечкин'},
      {surname: 'Санечкин'},
      {surname: 'Пупсик'},
      {surname: 'Антошин'}
    ],
    booksIssues: [
      {
        dateOfIssue: '01-09-2023',
        dueToDate: '03-09-2023',
        clientId: 1,
        bookId: 1
      },
      {
        dateOfIssue: '01-07-2023',
        dueToDate: '01-09-2023',
        clientId: 2,
        bookId: 2
      },
      {
        dateOfIssue: '01-05-2023',
        dueToDate: '03-09-2023',
        clientId: 1,
        bookId: 3
      },
      {
        dateOfIssue: '01-09-2023',
        dueToDate: '03-09-2023',
        clientId: 3,
        bookId: 2
      },
      {
        dateOfIssue: '01-02-2023',
        dueToDate: '03-05-2023',
        clientId: 1,
        bookId: 1
      },
      {
        dateOfIssue: '01-05-2023',
        dueToDate: '03-06-2023',
        clientId: 1,
        bookId: 1
      },
    ]
  },
  rent: {
    renters: [
      {surname: 'Козодоев'},
      {surname: 'Васечкин'},
      {surname: 'Куляшов'},
      {surname: 'Кудрев'},
      {surname: 'Ноздрев'},
      {surname: 'Максимов'},
      {surname: 'Дадашин'}
    ],
    objects: [
      {
        type: 'Квартира',
        cost: '88.24'
      },
      {
        type: 'Гараж',
        cost: '228.24'
      },
      {
        type: 'Общага',
        cost: '7821'
      },
      {
        type: 'Корабль',
        cost: '877'
      },
      {
        type: 'Детская площадка',
        cost: '200'
      },
      {
        type: 'Стадион "Геолог"',
        cost: '95000'
      }
    ],
    rentInfos: [
      {
        startingDate: '01-01-2023',
        rentLong: 3,
        objectId: 1,
        renterId: 1
      },
      {
        startingDate: '06-05-2023',
        rentLong: 2,
        objectId: 2,
        renterId: 1
      }
    ]
  },
  avia: {
    routes: [
      {destination: 'Пулково', cost: 777.25},
      {destination: 'Шереметьево', cost: 200},
      {destination: 'Рощино', cost: 999999},
    ],
    passengers: [
      {surname: 'Кот Леопольд'},
      {surname: 'Матроскин'},
      {surname: 'Шарик'},
      {surname: 'Мурка'},
    ],
    flights: [
      {
        dateOfIssue: '09-09-2023',
        passengerId: 1,
        routeId: 1
      }
    ]
  }
}

const up = async() => {
  const LIBRARY_DB_NAME = 'L_11_library'
  const RENT_DB_NAME = 'L_11_rent'
  const AVIA_DB_NAME = 'L_11_aviaTickets'

  await Promise.all([
    knex.raw(`CREATE DATABASE "${LIBRARY_DB_NAME}"`),
    knex.raw(`CREATE DATABASE "${RENT_DB_NAME}"`),
    knex.raw(`CREATE DATABASE "${AVIA_DB_NAME}"`)
  ]);

  const libraryKnex = getPGKnex(getBaseKnexConfig(LIBRARY_DB_NAME))
  const rentKnex = getPGKnex(getBaseKnexConfig(RENT_DB_NAME))
  const aviaKnex = getPGKnex(getBaseKnexConfig(AVIA_DB_NAME))

  const createLibraryTable = async() => {
    await libraryKnex.schema.createTable('books', (builder) => {
      builder.increments('id').comment('Код книги');
      builder.text('title').comment('Название книги');
      builder.text('authorName').comment('Автор');
    });
    await libraryKnex.schema.createTable('clients', (builder) => {
      builder.increments('id').comment('Код клиента');
      builder.text('surname').comment('Фамилия');
    });
    await libraryKnex.schema.createTable('booksIssues', (builder) => {
      builder.increments('id').comment('Код выдачи');
      builder.date('dateOfIssue').comment('Дата выдачи');
      builder.date('dueToDate').comment('Срок выдачи до');
      builder.integer('clientId').comment('Код клиента');
      builder.integer('bookId').comment('Код книги');
  
      builder.foreign('clientId').references('id').inTable('clients');
      builder.foreign('bookId').references('id').inTable('books');
    });

    await Promise.all([
      libraryKnex('books').insert(dataToInsert.library.books),
      libraryKnex('clients').insert(dataToInsert.library.clients)
    ]);
    await libraryKnex('booksIssues').insert(dataToInsert.library.booksIssues);
  };

  const createRentTable = async() => {
    await rentKnex.schema.createTable('renters', (builder) => {
      builder.increments('id').comment('Код арендатора');
      builder.text('surname').comment('Фамилия арендатора');
    });
    await rentKnex.schema.createTable('objects', (builder) => {
      builder.increments('id').comment('Код объекта');
      builder.text('type').comment('Тип объекта');
      builder.decimal('cost', 11, 2).comment('Стоимость');
    });
    await rentKnex.schema.createTable('rentInfos', (builder) => {
      builder.increments('id').comment('Код аренды');
      builder.date('startingDate').comment('Дата начала аренды');
      builder.integer('rentLong').comment('Длительность аренды (мес.)');
      builder.integer('objectId').comment('Код объекта');
      builder.integer('renterId').comment('Код арендатора');
  
      builder.foreign('objectId').references('id').inTable('objects');
      builder.foreign('renterId').references('id').inTable('renters');
    });

    await Promise.all([
      rentKnex('renters').insert(dataToInsert.rent.renters),
      rentKnex('objects').insert(dataToInsert.rent.objects)
    ]);
    await rentKnex('rentInfos').insert(dataToInsert.rent.rentInfos);
  };

  const createAviaTable = async() => {
    await aviaKnex.schema.createTable('routes', (builder) => {
      builder.increments('id').comment('Код рейса');
      builder.text('destination').comment('Аэропорт назначения');
      builder.decimal('cost', 11, 2).comment('Стоимость перелёта');
      
    });
    await aviaKnex.schema.createTable('passengers', (builder) => {
      builder.increments('id').comment('Код пассажира');
      builder.text('surname').comment('Фамилия')
    });
    await aviaKnex.schema.createTable('flights', (builder) => {
      builder.increments('id').comment('Код полёта');
      builder.date('dateOfIssue').comment('Дата полёта');
      builder.integer('passengerId').comment('Пассажир');
      builder.integer('routeId').comment('Рейс');
  
      builder.foreign('passengerId').references('id').inTable('passengers');
      builder.foreign('routeId').references('id').inTable('routes');
    });

    await Promise.all([
      aviaKnex('routes').insert(dataToInsert.avia.routes),
      aviaKnex('passengers').insert(dataToInsert.avia.passengers)
    ]);
    await aviaKnex('flights').insert(dataToInsert.avia.flights);
  }

  await Promise.all([
    createLibraryTable(),
    createRentTable(),
    createAviaTable()
  ])

  await Promise.all([
    libraryKnex.destroy(),
    rentKnex.destroy(),
    aviaKnex.destroy()
  ]);

  console.log('Done');
};

const destroyDB = () => {
  knex.destroy();
}

up().then(destroyDB);
