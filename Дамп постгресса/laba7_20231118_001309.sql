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
	(6, 'Веселина', 3, '666665', 8, 'ava6.jpg', NULL, NULL),
	(7, 'Мистер Х', 2, '00-00-00', 3, 'ava1.jpg', '2017-12-05 17:40:47', '2017-12-05 17:40:47'),
	(8, 'Мистер Х', 2, '00-00-00', 3, 'ava1.jpg', '2017-12-05 17:41:02', '2017-12-05 17:41:02'),
	(10, 'Алейников', 1, '00-00-00', 3, 'ava4.jpg', '2017-12-10 16:20:15', '2017-12-10 16:20:15');


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

SELECT pg_catalog.setval('public."Person_id_seq"', 1, false);


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

