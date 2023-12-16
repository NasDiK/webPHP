--
-- PostgreSQL database dump
--

-- Dumped from database version 15.2
-- Dumped by pg_dump version 15rc2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: Firm; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Firm" (
    id integer NOT NULL,
    "Name" character varying(255) NOT NULL,
    "Adress" character varying(255) NOT NULL
);


ALTER TABLE public."Firm" OWNER TO postgres;

--
-- Name: Firm_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Firm_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Firm_id_seq" OWNER TO postgres;

--
-- Name: Firm_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Firm_id_seq" OWNED BY public."Firm".id;


--
-- Name: Person; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Person" (
    id integer NOT NULL,
    "FIO" character varying(255) NOT NULL,
    "Staff" integer NOT NULL,
    "Phone" character varying(255) NOT NULL,
    "Stage" integer NOT NULL,
    "Image" character varying(255) NOT NULL,
    created_at timestamp without time zone,
    updated_at timestamp without time zone
);


ALTER TABLE public."Person" OWNER TO postgres;

--
-- Name: Person_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Person_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Person_id_seq" OWNER TO postgres;

--
-- Name: Person_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Person_id_seq" OWNED BY public."Person".id;


--
-- Name: Staff; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Staff" (
    id integer NOT NULL,
    staff character varying(255) NOT NULL
);


ALTER TABLE public."Staff" OWNER TO postgres;

--
-- Name: Staff_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Staff_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Staff_id_seq" OWNER TO postgres;

--
-- Name: Staff_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Staff_id_seq" OWNED BY public."Staff".id;


--
-- Name: Vacancy; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."Vacancy" (
    id integer NOT NULL,
    "Firm" integer NOT NULL,
    "Staff" integer NOT NULL
);


ALTER TABLE public."Vacancy" OWNER TO postgres;

--
-- Name: Vacancy_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."Vacancy_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."Vacancy_id_seq" OWNER TO postgres;

--
-- Name: Vacancy_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."Vacancy_id_seq" OWNED BY public."Vacancy".id;


--
-- Name: Firm id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Firm" ALTER COLUMN id SET DEFAULT nextval('public."Firm_id_seq"'::regclass);


--
-- Name: Person id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Person" ALTER COLUMN id SET DEFAULT nextval('public."Person_id_seq"'::regclass);


--
-- Name: Staff id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Staff" ALTER COLUMN id SET DEFAULT nextval('public."Staff_id_seq"'::regclass);


--
-- Name: Vacancy id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Vacancy" ALTER COLUMN id SET DEFAULT nextval('public."Vacancy_id_seq"'::regclass);


--
-- Data for Name: Firm; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Firm" VALUES
	(1, 'ОАО Этажи', 'Тюмень, ул.Ленина, 35'),
	(2, 'ООО Престиж', 'Тюмень, ул.Профсоюзная, 8'),
	(3, 'ИП Зуевский', 'Тюмень, ул.Пирогова, 34-61');


--
-- Data for Name: Person; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Person" VALUES
	(5, 'Калугин', 3, '555555', 6, 'ava5.jpg', NULL, NULL),
	(7, 'Мистер Х', 2, '00-00-00', 3, 'ava1.jpg', '2017-12-05 17:40:47', '2017-12-05 17:40:47'),
	(10, 'Алейников', 1, '00-00-00', 3, 'ava4.jpg', '2017-12-10 16:20:15', '2017-12-10 16:20:15'),
	(3, 'Tungusov', 1, '79199454414', 5, 'testTEST.png', '2023-11-26 10:38:13', '2023-11-26 10:38:13'),
	(11, '1231231', 4, 'dsfsfasfasdf', 4, 'testTEST.png', '2023-11-26 10:41:23', '2023-11-26 10:41:23'),
	(12, '123', 1, '123123', 123123, 'testTEST.png', '2023-11-26 11:06:37', '2023-11-26 11:06:37'),
	(13, '123', 1, '123123', 123123, 'testTEST.png', '2023-11-26 11:06:52', '2023-11-26 11:06:52'),
	(14, '123123', 1, '123123', 123123, 'testTEST.png', '2023-11-26 11:06:56', '2023-11-26 11:06:56'),
	(15, '123', 1, '123', 123, '1700998347.jpg', '2023-11-26 11:32:27', '2023-11-26 11:32:27'),
	(16, '123', 1, '123', 12, '1700999136.txt', '2023-11-26 11:45:36', '2023-11-26 11:45:36'),
	(18, '12312', 1, '123123', 4, '1700999257.png', '2023-11-26 11:47:37', '2023-11-26 11:47:37'),
	(20, 'asdfasdf', 2, '123', 55, '1700999336.png', '2023-11-26 11:48:56', '2023-11-26 11:48:56'),
	(21, 'asdfasdfasdfasd', 4, '7657655656', 15435, '1700999562.jpg', '2023-11-26 11:52:42', '2023-11-26 11:52:42'),
	(8, 'Мистер Х', 2, '00-22-22', 3, 'ava1.jpg', '2017-12-05 17:41:02', '2023-11-26 17:00:10'),
	(23, 'выавы', 4, '79299', 5, '1702717830.jpg', '2023-12-16 09:10:30', '2023-12-16 09:10:30'),
	(24, 'fasdfas', 3, '7999999', 12, '1702717900.jpg', '2023-12-16 09:11:40', '2023-12-16 09:11:40');


--
-- Data for Name: Staff; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Staff" VALUES
	(1, 'Программист'),
	(2, 'Менеджер'),
	(3, 'Дизайнер'),
	(4, 'Дворник');


--
-- Data for Name: Vacancy; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public."Vacancy" VALUES
	(1, 1, 1),
	(2, 1, 2),
	(3, 3, 2);


--
-- Name: Firm_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Firm_id_seq"', 3, false);


--
-- Name: Person_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Person_id_seq"', 24, true);


--
-- Name: Staff_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Staff_id_seq"', 4, true);


--
-- Name: Vacancy_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."Vacancy_id_seq"', 3, true);


--
-- Name: Firm Firm_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Firm"
    ADD CONSTRAINT "Firm_pkey" PRIMARY KEY (id);


--
-- Name: Person Person_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Person"
    ADD CONSTRAINT "Person_pkey" PRIMARY KEY (id);


--
-- Name: Staff Staff_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Staff"
    ADD CONSTRAINT "Staff_pkey" PRIMARY KEY (id);


--
-- Name: Vacancy Vacancy_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Vacancy"
    ADD CONSTRAINT "Vacancy_pkey" PRIMARY KEY (id);


--
-- Name: Vacancy firm_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Vacancy"
    ADD CONSTRAINT firm_fk FOREIGN KEY ("Firm") REFERENCES public."Firm"(id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Vacancy staff_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Vacancy"
    ADD CONSTRAINT staff_fk FOREIGN KEY ("Staff") REFERENCES public."Staff"(id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: Person staff_fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."Person"
    ADD CONSTRAINT staff_fk FOREIGN KEY ("Staff") REFERENCES public."Staff"(id) MATCH FULL ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

