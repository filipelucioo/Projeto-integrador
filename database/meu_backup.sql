--
-- PostgreSQL database dump
--

\restrict 7Xrspbu0qeCnlsTjHDI1VJYuciIDamjFZg7HhCflpHxhDKrF8QIW2kp9UC7rJ0K

-- Dumped from database version 18.4 (Ubuntu 18.4-0ubuntu0.26.04.1)
-- Dumped by pg_dump version 18.4 (Ubuntu 18.4-0ubuntu0.26.04.1)

-- Started on 2026-10-20 17:01:30 UTC

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
-- TOC entry 222 (class 1259 OID 24693)
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

--
-- TOC entry 221 (class 1259 OID 24692)
-- Name: jogadores_id_seq; Type: SEQUENCE; Schema: public; Owner: campeonato
--

CREATE SEQUENCE public.jogadores_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jogadores_id_seq OWNER TO campeonato;

--
-- TOC entry 3532 (class 0 OID 0)
-- Dependencies: 221
-- Name: jogadores_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: campeonato
--

ALTER SEQUENCE public.jogadores_id_seq OWNED BY public.jogadores.id;


--
-- TOC entry 228 (class 1259 OID 41016)
-- Name: jogo_gols; Type: TABLE; Schema: public; Owner: campeonato
--

CREATE TABLE public.jogo_gols (
    id integer NOT NULL,
    jogo_id integer NOT NULL,
    jogador_id integer NOT NULL,
    quantidade integer NOT NULL
);


ALTER TABLE public.jogo_gols OWNER TO campeonato;

--
-- TOC entry 227 (class 1259 OID 41015)
-- Name: jogo_gols_id_seq; Type: SEQUENCE; Schema: public; Owner: campeonato
--

CREATE SEQUENCE public.jogo_gols_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jogo_gols_id_seq OWNER TO campeonato;

--
-- TOC entry 3533 (class 0 OID 0)
-- Dependencies: 227
-- Name: jogo_gols_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: campeonato
--

ALTER SEQUENCE public.jogo_gols_id_seq OWNED BY public.jogo_gols.id;


--
-- TOC entry 226 (class 1259 OID 40993)
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

--
-- TOC entry 225 (class 1259 OID 40992)
-- Name: jogos_id_seq; Type: SEQUENCE; Schema: public; Owner: campeonato
--

CREATE SEQUENCE public.jogos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jogos_id_seq OWNER TO campeonato;

--
-- TOC entry 3534 (class 0 OID 0)
-- Dependencies: 225
-- Name: jogos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: campeonato
--

ALTER SEQUENCE public.jogos_id_seq OWNED BY public.jogos.id;


--
-- TOC entry 220 (class 1259 OID 24681)
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

--
-- TOC entry 219 (class 1259 OID 24680)
-- Name: times_id_seq; Type: SEQUENCE; Schema: public; Owner: campeonato
--

CREATE SEQUENCE public.times_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.times_id_seq OWNER TO campeonato;

--
-- TOC entry 3535 (class 0 OID 0)
-- Dependencies: 219
-- Name: times_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: campeonato
--

ALTER SEQUENCE public.times_id_seq OWNED BY public.times.id;


--
-- TOC entry 224 (class 1259 OID 40980)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: campeonato
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    email character varying(150) NOT NULL,
    senha character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.usuarios OWNER TO campeonato;

--
-- TOC entry 223 (class 1259 OID 40979)
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: campeonato
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_seq OWNER TO campeonato;

--
-- TOC entry 3536 (class 0 OID 0)
-- Dependencies: 223
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: campeonato
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- TOC entry 3345 (class 2604 OID 24696)
-- Name: jogadores id; Type: DEFAULT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogadores ALTER COLUMN id SET DEFAULT nextval('public.jogadores_id_seq'::regclass);


--
-- TOC entry 3352 (class 2604 OID 41019)
-- Name: jogo_gols id; Type: DEFAULT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogo_gols ALTER COLUMN id SET DEFAULT nextval('public.jogo_gols_id_seq'::regclass);


--
-- TOC entry 3349 (class 2604 OID 40996)
-- Name: jogos id; Type: DEFAULT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogos ALTER COLUMN id SET DEFAULT nextval('public.jogos_id_seq'::regclass);


--
-- TOC entry 3344 (class 2604 OID 24684)
-- Name: times id; Type: DEFAULT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.times ALTER COLUMN id SET DEFAULT nextval('public.times_id_seq'::regclass);


--
-- TOC entry 3347 (class 2604 OID 40983)
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- TOC entry 3520 (class 0 OID 24693)
-- Dependencies: 222
-- Data for Name: jogadores; Type: TABLE DATA; Schema: public; Owner: campeonato
--

COPY public.jogadores (id, time_id, nome, cpf, data_nascimento, telefone, nome_responsavel, telefone_responsavel, gols) FROM stdin;
2	2	FILIPE LUCIO DA SILVA	123456787654	2026-10-31	19 99999 9999	FERNANDA	1999999999	0
41	8	Naza	666000666	0820-04-09	2492482	\N	\N	2
10	1	Celis	48104938249	2009-07-08	+5519971274811	\N	\N	4
11	1	Gordovani	66600066667	2001-09-11	+5519971274811	\N	\N	7
5	4	luccas neto	99292929292	2026-10-06	12345344321	\N	\N	1
45	7	Sr. Adolfo (Vô do Balofo)	22p94u8235	275760-05-23	64213725486597	\N	\N	0
6	4	GISELE LUCIO DA SILVA	18481749198	1945-04-19	+5519971274811	\N	\N	5
46	1	Expulso do time (Balta)	23463573575	75475-05-31	r5697698697456345234	\N	\N	0
47	7	Vorcaro	12452346325624	234634-05-23	2346327898765	\N	\N	0
33	9	Clóvis Basilio	3	0003-03-03	3	\N	\N	1
8	1	Abraão Morreu?	00000000000000	0001-01-01	000000000000000	Original	\N	0
38	9	Goleiro Bruno	2462356	234664-04-23	234623466	\N	\N	3
34	9	Robinho 7	123456	0005-04-04	1232334	\N	\N	1
48	7	Me Rexpeita CRÉU	1425768574574	7275-03-04	25286835	\N	\N	1
3	3	CARLOS MORATO	194520010911	2026-10-21	19 99999 9999	GABIGOL	1999999999	14
1	1	Arroganthi	66699969699	2009-08-19	19 99999 9999	Gisele Lucio	1999999999	8
44	7	O Cara Q Conseguiu Ser Expulso Do Polivalente (Miguel Alves)	4951807425	217515-03-12	io21u345yp35u	\N	\N	3
9	1	Pachutoci	48104818450	2000-09-04	4828491839	\N	\N	2
13	5	Lulu César	24981984148104	1843-07-04	284918491481	\N	\N	3
12	5	Mariana Mãe	284810481040	2003-03-18	28491749184	\N	\N	4
14	6	Curtiu Mandei	12345678765432	275760-03-12	563576432857364	niggaci	543687oi654879	67
15	6	Papa nn Aleatory	123467890	275760-03-04	724634576475	\N	\N	0
16	6	Mangueira	29208-438926-8	0010-03-27	6909863-24	\N	\N	0
17	6	Eterno Quadradinho, sdds 🕊️	1298371025	275760-03-12	02983457023498	Suiça	5782-8924	0
18	6	Entrosa PRIME ☠️☠️☠️☠️	123	0563-07-06	3965046890986243	\N	\N	0
19	4	Pagé PEPT	15689-325	4368-09-08	906823519806423	\N	\N	0
20	4	Marcos Vitarelli	7827248-3-2487	0042-03-01	936420934-8792t30	\N	\N	0
21	4	Mirela Tainá 	21309856437968	275760-06-12	q56475869708=-	\N	\N	0
22	4	Danilo Professor 	88959t3w894439	275760-04-21	34267654	\N	\N	0
23	4	Ramon ex professor de Geografia	10269853	8906-12-05	65234902385	\N	\N	0
24	4	Pietro Milani	52307523190632	275760-07-09	p02490586509215	\N	\N	0
26	1	NAPRTK	123456754	2026-10-23	(19) 93822-3813	\N	\N	0
28	6	Poliana Almoça	31234234897	2026-10-22	19 91238-1238	\N	\N	0
4	2	GOATNI	12345678043	2026-10-27	19 99999 9999	marcio castanha	1999999999	10
25	2	Marcio Denadai Travas de Titânio	01 -o primeiro	275760-09-07	8uy34282314	\N	\N	3
7	2	Pachutopin	66666666666	1945-09-11	+5519971274811	LILICI	\N	2
30	8	Molho Especial	248194818492	9429-09-04	2949294	\N	\N	1
31	8	Poltrona Quebrada	28492948294	2003-04-28	482848284	\N	\N	1
35	9	Little Raul	23124	1244-12-04	12318ry	\N	\N	0
36	9	Raul Judas do Polivalente	253678564	0257-07-25	3457243	\N	\N	0
37	9	Patrick Estrela	5	0005-05-05	5	\N	\N	0
39	9	Dimas Cândido de Oliveira Filho	q3463573475472	275760-07-24	2345445676	\N	\N	0
40	7	Maria Eduarda Mamãe do ano passado	2v1	123414-04-23	123424365765	\N	\N	0
42	7	Baiano O Cara Mais Suave Daqui	o9832765045	2026-02-04	09843206496	\N	\N	0
43	1	Scalfi (Repelente de titulos)	24820582492	9203-04-18	7972374394	\N	\N	0
32	8	Brr Brr Batapim	2492859295	1945-09-11	2492948284	\N	\N	4
29	7	Sophia Marino	66600066667	2000-12-31	666000666	\N	\N	1
\.


--
-- TOC entry 3526 (class 0 OID 41016)
-- Dependencies: 228
-- Data for Name: jogo_gols; Type: TABLE DATA; Schema: public; Owner: campeonato
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
-- TOC entry 3524 (class 0 OID 40993)
-- Dependencies: 226
-- Data for Name: jogos; Type: TABLE DATA; Schema: public; Owner: campeonato
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
-- TOC entry 3518 (class 0 OID 24681)
-- Dependencies: 220
-- Data for Name: times; Type: TABLE DATA; Schema: public; Owner: campeonato
--

COPY public.times (id, nome, tecnico, cpf_tecnico, data_nascimento, telefone) FROM stdin;
1	Al Mossar	The Man	194520010911	2001-09-11	19 99999 9999
2	Gabigol	fernandes	123456789	2026-10-21	19 99999 9999
3	jorgejorge	jorge	194520010911	2026-10-21	19 99999 9999
4	CKJA FC	Teixeira	234567876	2026-10-21	123456765432
5	Deportivo De La Jánta	Eduardo de Celis	46792817340	2002-08-23	178387228372
6	Fúria	Cairo	504.252.178-59	1945-07-06	19 992117891
7	Fútbol Club Cafe del Tarde	Kauam Bielsi	28482104028	9120-04-08	49129491
8	Maria Lanches FC	Maria	29482984249	2949-04-19	28482849
9	Atletico de Café da Manha	Lazaro Barbosa	2	0002-02-02	9081274109834
\.


--
-- TOC entry 3522 (class 0 OID 40980)
-- Dependencies: 224
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: campeonato
--

COPY public.usuarios (id, email, senha, created_at) FROM stdin;
1	gisele@ruajupiter	$2y$12$blN85Ysni8g5AWkALIHjKO/0WESmXZNLwTLC6RqCn8NGZ5uhd2YUq	2026-10-20 10:22:25.232321
2	jao@gardi.sfd	$2y$12$U9/wy2oySDKyG6FC0Amt1.ZMIsLk6NxumIVZX/MXva3pUNaSWCCWe	2026-10-20 13:48:20.265988
3	jorge@jorge	$2y$12$fAkYQaejPe745Acy/Cct4eqfPTYYTdpV8Y/BoA0bmNirivlllFIWy	2026-10-20 14:50:17.512041
4	gregci@gmail.com	$2y$12$Ru/KiMdf5yMPAHuvqwUdjeu2fOcITVyfIWwPV6V0m6noLJFerN9Sa	2026-10-20 15:25:46.807412
5	adm@adm	$2y$12$L77o10qVBb54JEfnb79ovO6kOZbfxGtWhwXCQstEh8nr8f6MgmUmG	2026-10-20 16:08:12.427569
6	gisele@jupiter	$2y$12$SEySagpA8d3FiAw1iGIiNelZv8CXmU1NSzU8BPUzTX5tBE6PhM7IG	2026-10-20 16:29:02.098974
\.


--
-- TOC entry 3537 (class 0 OID 0)
-- Dependencies: 221
-- Name: jogadores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: campeonato
--

SELECT pg_catalog.setval('public.jogadores_id_seq', 48, true);


--
-- TOC entry 3538 (class 0 OID 0)
-- Dependencies: 227
-- Name: jogo_gols_id_seq; Type: SEQUENCE SET; Schema: public; Owner: campeonato
--

SELECT pg_catalog.setval('public.jogo_gols_id_seq', 38, true);


--
-- TOC entry 3539 (class 0 OID 0)
-- Dependencies: 225
-- Name: jogos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: campeonato
--

SELECT pg_catalog.setval('public.jogos_id_seq', 15, true);


--
-- TOC entry 3540 (class 0 OID 0)
-- Dependencies: 219
-- Name: times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: campeonato
--

SELECT pg_catalog.setval('public.times_id_seq', 9, true);


--
-- TOC entry 3541 (class 0 OID 0)
-- Dependencies: 223
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: campeonato
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 6, true);


--
-- TOC entry 3356 (class 2606 OID 24704)
-- Name: jogadores jogadores_pkey; Type: CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogadores
    ADD CONSTRAINT jogadores_pkey PRIMARY KEY (id);


--
-- TOC entry 3364 (class 2606 OID 41025)
-- Name: jogo_gols jogo_gols_pkey; Type: CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogo_gols
    ADD CONSTRAINT jogo_gols_pkey PRIMARY KEY (id);


--
-- TOC entry 3362 (class 2606 OID 41004)
-- Name: jogos jogos_pkey; Type: CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogos
    ADD CONSTRAINT jogos_pkey PRIMARY KEY (id);


--
-- TOC entry 3354 (class 2606 OID 24691)
-- Name: times times_pkey; Type: CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.times
    ADD CONSTRAINT times_pkey PRIMARY KEY (id);


--
-- TOC entry 3358 (class 2606 OID 40991)
-- Name: usuarios usuarios_email_key; Type: CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_email_key UNIQUE (email);


--
-- TOC entry 3360 (class 2606 OID 40989)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- TOC entry 3365 (class 2606 OID 24705)
-- Name: jogadores jogadores_time_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogadores
    ADD CONSTRAINT jogadores_time_id_fkey FOREIGN KEY (time_id) REFERENCES public.times(id);


--
-- TOC entry 3368 (class 2606 OID 41031)
-- Name: jogo_gols jogo_gols_jogador_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogo_gols
    ADD CONSTRAINT jogo_gols_jogador_id_fkey FOREIGN KEY (jogador_id) REFERENCES public.jogadores(id);


--
-- TOC entry 3369 (class 2606 OID 41026)
-- Name: jogo_gols jogo_gols_jogo_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogo_gols
    ADD CONSTRAINT jogo_gols_jogo_id_fkey FOREIGN KEY (jogo_id) REFERENCES public.jogos(id) ON DELETE CASCADE;


--
-- TOC entry 3366 (class 2606 OID 41005)
-- Name: jogos jogos_time_casa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogos
    ADD CONSTRAINT jogos_time_casa_id_fkey FOREIGN KEY (time_casa_id) REFERENCES public.times(id);


--
-- TOC entry 3367 (class 2606 OID 41010)
-- Name: jogos jogos_time_fora_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: campeonato
--

ALTER TABLE ONLY public.jogos
    ADD CONSTRAINT jogos_time_fora_id_fkey FOREIGN KEY (time_fora_id) REFERENCES public.times(id);


-- Completed on 2026-10-20 17:01:35 UTC

--
-- PostgreSQL database dump complete
--

\unrestrict 7Xrspbu0qeCnlsTjHDI1VJYuciIDamjFZg7HhCflpHxhDKrF8QIW2kp9UC7rJ0K

