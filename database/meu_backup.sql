--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
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
-- Name: times; Type: TABLE; Schema: public; Owner: campeonato
--

CREATE TABLE public.times (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    tecnico character varying(100) NOT NULL,
    cpf_tecnico character varying(40) NOT NULL,
    data_nascimento date NOT NULL,
    telefone character varying(20)
);

ALTER TABLE public.times OWNER TO campeonato;

CREATE SEQUENCE public.times_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.times_id_seq OWNER TO campeonato;
ALTER SEQUENCE public.times_id_seq OWNED BY public.times.id;

--
-- Name: jogadores; Type: TABLE; Schema: public; Owner: campeonato
--

CREATE TABLE public.jogadores (
    id integer NOT NULL,
    time_id integer NOT NULL,
    nome character varying(100) NOT NULL,
    cpf character varying(14) NOT NULL,
    data_nascimento date NOT NULL,
    telefone character varying(20),
    nome_responsavel character varying(100),
    telefone_responsavel character varying(20),
    gols integer DEFAULT 0
);

ALTER TABLE public.jogadores OWNER TO campeonato;

CREATE SEQUENCE public.jogadores_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.jogadores_id_seq OWNER TO campeonato;
ALTER SEQUENCE public.jogadores_id_seq OWNED BY public.jogadores.id;

--
-- Name: jogos; Type: TABLE; Schema: public; Owner: campeonato
--

CREATE TABLE public.jogos (
    id integer NOT NULL,
    time_casa_id integer NOT NULL,
    time_fora_id integer NOT NULL,
    gols_casa integer DEFAULT 0,
    gols_fora integer DEFAULT 0,
    data_jogo date NOT NULL
);

ALTER TABLE public.jogos OWNER TO campeonato;

CREATE SEQUENCE public.jogos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.jogos_id_seq OWNER TO campeonato;
ALTER SEQUENCE public.jogos_id_seq OWNED BY public.jogos.id;

--
-- Name: jogo_gols; Type: TABLE; Schema: public; Owner: campeonato
--

CREATE TABLE public.jogo_gols (
    id integer NOT NULL,
    jogo_id integer NOT NULL,
    jogador_id integer NOT NULL,
    quantidade integer NOT NULL
);

ALTER TABLE public.jogo_gols OWNER TO campeonato;

CREATE SEQUENCE public.jogo_gols_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.jogo_gols_id_seq OWNER TO campeonato;
ALTER SEQUENCE public.jogo_gols_id_seq OWNED BY public.jogo_gols.id;

--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: campeonato
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    email character varying(150) NOT NULL,
    senha character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE public.usuarios OWNER TO campeonato;

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;

ALTER SEQUENCE public.usuarios_id_seq OWNER TO campeonato;
ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;

--
-- Defaults
--

ALTER TABLE ONLY public.jogadores ALTER COLUMN id SET DEFAULT nextval('public.jogadores_id_seq'::regclass);
ALTER TABLE ONLY public.jogo_gols ALTER COLUMN id SET DEFAULT nextval('public.jogo_gols_id_seq'::regclass);
ALTER TABLE ONLY public.jogos ALTER COLUMN id SET DEFAULT nextval('public.jogos_id_seq'::regclass);
ALTER TABLE ONLY public.times ALTER COLUMN id SET DEFAULT nextval('public.times_id_seq'::regclass);
ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);

--
-- Data for Name: times
--

COPY public.times (id, nome, tecnico, cpf_tecnico, data_nascimento, telefone) FROM stdin;
1	Al Mossar	The Man	194520010911	2001-09-11	19 99999 9999
2	Gabigol	fernandes	123456789	2026-10-21	19 99999 9999
3	jorgejorge	jorge	194520010911	2026-10-21	19 99999 9999
4	CKJA FC	Teixeira	234567876	2026-10-21	123456765432
5	Deportivo De La Jánta	Eduardo de Celis	46792817340	2002-08-23	178387228372
6	Fúria	Cairo	504.252.178-59	1945-07-06	19 992117891
7	Fútbol Club Cafe del Tarde	Kauam Bielsi	28482104028	2000-04-08	49129491
8	Maria Lanches FC	Maria	29482984249	2000-04-19	28482849
9	Atletico de Café da Manha	Lazaro Barbosa	2	2000-02-02	9081274109834
\.

--
-- Data for Name: jogadores
--

COPY public.jogadores (id, time_id, nome, cpf, data_nascimento, telefone, nome_responsavel, telefone_responsavel, gols) FROM stdin;
1	1	Arroganthi	66699969699	2009-08-19	19 99999 9999	Gisele Lucio	1999999999	8
2	2	FILIPE LUCIO DA SILVA	123456787654	2006-10-31	19 99999 9999	FERNANDA	1999999999	0
3	3	CARLOS MORATO	194520010911	2006-10-21	19 99999 9999	GABIGOL	1999999999	14
4	2	GOATNI	12345678043	2006-10-27	19 99999 9999	marcio castanha	1999999999	10
5	4	luccas neto	99292929292	2006-10-06	12345344321	\N	\N	1
6	4	Jogador 6	00000000006	2000-01-01	\N	\N	\N	5
7	2	Jogador 7	00000000007	2000-01-01	\N	\N	\N	2
8	1	Abraão Morreu?	00000000000	2001-01-01	00000000000	Original	\N	0
9	1	Jogador 9	00000000009	2000-01-01	\N	\N	\N	2
10	1	Celis	48104938249	2009-07-08	+5519971274811	\N	\N	4
11	1	Gordovani	66600066667	2001-09-11	+5519971274811	\N	\N	7
12	5	Jogador 12	00000000012	2000-01-01	\N	\N	\N	4
13	5	Jogador 13	00000000013	2000-01-01	\N	\N	\N	3
14	6	Jogador 14	00000000014	2000-01-01	\N	\N	\N	67
15	6	Papa nn Aleatory	12346789011	2000-03-04	724634576475	\N	\N	0
16	6	Mangueira	29208438926	2000-03-27	6909863-24	\N	\N	0
17	6	Eterno Quadradinho, sdds 🕊️	12983710251	2000-03-12	02983457023498	Suiça	5782-8924	0
18	6	Entrosa PRIME ☠️☠️☠️☠️	12300000000	2000-07-06	3965046890986243	\N	\N	0
19	4	Pagé PEPT	15689325000	2000-09-08	906823519806423	\N	\N	0
22	4	Danilo Professor	88959389443	2000-04-21	34267654	\N	\N	0
23	4	Ramon ex professor de Geografia	10269853000	2000-12-05	65234902385	\N	\N	0
24	4	Pietro Milani	52307523190	2000-07-09	19999999999	\N	\N	0
25	2	Marcio Denadai Travas de Titânio	01000000000	2000-09-07	8uy34282314	\N	\N	3
26	1	NAPRTK	12345675400	2006-10-23	(19) 93822-3813	\N	\N	0
29	7	Jogador 29	00000000029	2000-01-01	\N	\N	\N	1
30	8	Jogador 30	00000000030	2000-01-01	\N	\N	\N	1
31	8	Jogador 31	00000000031	2000-01-01	\N	\N	\N	1
32	8	Brr Brr Batapim	24928592950	1945-09-11	2492948284	\N	\N	4
33	9	Jogador 33	00000000033	2000-01-01	\N	\N	\N	1
34	9	Jogador 34	00000000034	2000-01-01	\N	\N	\N	1
35	9	Little Raul	23124000000	2004-12-04	12318ry	\N	\N	0
36	9	Raul Judas do Polivalente	25367856400	2005-07-25	3457243	\N	\N	0
37	9	Patrick Estrela	50000000000	2005-05-05	5	\N	\N	0
38	9	Jogador 38	00000000038	2000-01-01	\N	\N	\N	3
39	9	Dimas Cândido de Oliveira Filho	34635734754	2000-07-24	2345445676	\N	\N	0
40	7	Maria Eduarda Mamãe do ano passado	20000000000	2004-04-23	123424365765	\N	\N	0
41	8	Jogador 41	00000000041	2000-01-01	\N	\N	\N	2
42	7	Baiano O Cara Mais Suave Daqui	09832765045	2006-02-04	09843206496	\N	\N	0
43	1	Scalfi (Repelente de titulos)	24820582492	2003-04-18	7972374394	\N	\N	0
44	7	Miguel Alves	49518074250	2005-03-12	19999999999	\N	\N	3
46	1	Expulso do time (Balta)	23463573575	2005-05-31	19999999999	\N	\N	0
48	7	Me Rexpeita CRÉU	14257685745	2005-03-04	25286835	\N	\N	1
\.

--
-- Data for Name: jogos
--

COPY public.jogos (id, time_casa_id, time_fora_id, gols_casa, gols_fora, data_jogo) FROM stdin;
1	1	2	2	3	2026-10-20
3	1	3	3	4	2026-10-20
4	1	4	4	1	2001-09-11
5	4	3	4	3	2026-10-20
6	4	2	5	2	2026-10-20
7	2	3	5	5	2026-10-20
8	1	3	4	3	2026-10-20
9	1	5	6	7	2026-10-20
10	6	4	67	0	2026-10-20
11	6	4	0	0	2026-10-20
12	2	3	8	0	2001-09-11
13	8	1	4	3	2026-10-20
14	8	1	4	2	2026-10-20
15	9	7	5	5	2026-10-20
\.

--
-- Data for Name: jogo_gols
--

COPY public.jogo_gols (id, jogo_id, jogador_id, quantidade) FROM stdin;
1	3	1	3
2	3	3	4
3	4	1	3
4	4	5	1
5	5	3	3
6	6	6	5
7	6	4	2
8	7	4	4
9	7	7	1
10	7	3	4
11	8	10	1
12	8	11	2
13	8	9	1
14	8	3	3
15	9	1	2
16	9	10	2
17	9	11	1
18	9	9	1
19	9	13	3
20	9	12	4
21	10	14	67
22	12	4	4
23	12	25	3
24	12	7	1
25	13	32	2
26	13	30	1
27	13	31	1
28	13	11	3
29	14	32	2
30	14	41	2
31	14	10	1
32	14	11	1
33	15	33	1
34	15	38	3
35	15	34	1
36	15	48	1
37	15	44	3
38	15	29	1
\.

--
-- Data for Name: usuarios
--

COPY public.usuarios (id, email, senha, created_at) FROM stdin;
3	jorge@jorge	$2y$12$fAkYQaejPe745Acy/Cct4eqfPTYYTdpV8Y/BoA0bmNirivlllFIWy	2026-10-20 14:50:17.512041
4	gregci@gmail.com	$2y$12$Ru/KiMdf5yMPAHuvqwUdjeu2fOcITVyfIWwPV6V0m6noLJFerN9Sa	2026-10-20 15:25:46.807412
5	adm@adm	$2y$12$L77o10qVBb54JEfnb79ovO6kOZbfxGtWhwXCQstEh8nr8f6MgmUmG	2026-10-20 16:08:12.427569
\.

--
-- Set sequence values
--

SELECT pg_catalog.setval('public.jogadores_id_seq', 48, true);
SELECT pg_catalog.setval('public.jogo_gols_id_seq', 38, true);
SELECT pg_catalog.setval('public.jogos_id_seq', 15, true);
SELECT pg_catalog.setval('public.times_id_seq', 9, true);
SELECT pg_catalog.setval('public.usuarios_id_seq', 6, true);

--
-- Primary Keys & Constraints
--

ALTER TABLE ONLY public.times
    ADD CONSTRAINT times_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.jogadores
    ADD CONSTRAINT jogadores_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.jogos
    ADD CONSTRAINT jogos_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.jogo_gols
    ADD CONSTRAINT jogo_gols_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_email_key UNIQUE (email);

--
-- Foreign Keys
--

ALTER TABLE ONLY public.jogadores
    ADD CONSTRAINT jogadores_time_id_fkey FOREIGN KEY (time_id) REFERENCES public.times(id);

ALTER TABLE ONLY public.jogos
    ADD CONSTRAINT jogos_time_casa_id_fkey FOREIGN KEY (time_casa_id) REFERENCES public.times(id);

ALTER TABLE ONLY public.jogos
    ADD CONSTRAINT jogos_time_fora_id_fkey FOREIGN KEY (time_fora_id) REFERENCES public.times(id);

ALTER TABLE ONLY public.jogo_gols
    ADD CONSTRAINT jogo_gols_jogador_id_fkey FOREIGN KEY (jogador_id) REFERENCES public.jogadores(id);

ALTER TABLE ONLY public.jogo_gols
    ADD CONSTRAINT jogo_gols_jogo_id_fkey FOREIGN KEY (jogo_id) REFERENCES public.jogos(id) ON DELETE CASCADE;
