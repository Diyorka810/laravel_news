--
-- PostgreSQL database dump
--

-- Dumped from database version 17.5
-- Dumped by pg_dump version 17.5

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
-- Name: cache; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO admin;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO admin;

--
-- Name: categories; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    parent_id bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.categories OWNER TO admin;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO admin;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: category_translations; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.category_translations (
    id bigint NOT NULL,
    category_id bigint NOT NULL,
    locale character varying(5) NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.category_translations OWNER TO admin;

--
-- Name: category_translations_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.category_translations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.category_translations_id_seq OWNER TO admin;

--
-- Name: category_translations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.category_translations_id_seq OWNED BY public.category_translations.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO admin;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO admin;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO admin;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO admin;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO admin;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO admin;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO admin;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO admin;

--
-- Name: post_categories; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.post_categories (
    post_id bigint NOT NULL,
    category_id bigint NOT NULL
);


ALTER TABLE public.post_categories OWNER TO admin;

--
-- Name: post_images; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.post_images (
    id bigint NOT NULL,
    post_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    is_cover boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.post_images OWNER TO admin;

--
-- Name: post_images_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.post_images_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.post_images_id_seq OWNER TO admin;

--
-- Name: post_images_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.post_images_id_seq OWNED BY public.post_images.id;


--
-- Name: post_translations; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.post_translations (
    id bigint NOT NULL,
    post_id bigint NOT NULL,
    locale character varying(5) NOT NULL,
    title character varying(255) NOT NULL,
    content text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.post_translations OWNER TO admin;

--
-- Name: post_translations_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.post_translations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.post_translations_id_seq OWNER TO admin;

--
-- Name: post_translations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.post_translations_id_seq OWNED BY public.post_translations.id;


--
-- Name: posts; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.posts (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    is_published boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.posts OWNER TO admin;

--
-- Name: sessions; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO admin;

--
-- Name: user_posts_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.user_posts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_posts_id_seq OWNER TO admin;

--
-- Name: user_posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.user_posts_id_seq OWNED BY public.posts.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: admin
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    user_name character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    first_name character varying(255) NOT NULL,
    last_name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    sex character varying(255) NOT NULL,
    is_admin boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT users_sex_check CHECK (((sex)::text = ANY ((ARRAY['male'::character varying, 'female'::character varying])::text[])))
);


ALTER TABLE public.users OWNER TO admin;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO admin;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: admin
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: category_translations id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.category_translations ALTER COLUMN id SET DEFAULT nextval('public.category_translations_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: post_images id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_images ALTER COLUMN id SET DEFAULT nextval('public.post_images_id_seq'::regclass);


--
-- Name: post_translations id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_translations ALTER COLUMN id SET DEFAULT nextval('public.post_translations_id_seq'::regclass);


--
-- Name: posts id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.posts ALTER COLUMN id SET DEFAULT nextval('public.user_posts_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.categories (id, name, slug, parent_id, created_at, updated_at) FROM stdin;
1	IT	it	\N	2025-06-26 09:34:27	2025-06-26 09:34:27
2	Front-end	front	1	2025-06-26 09:34:27	2025-06-26 09:34:27
3	Back-end	back	1	2025-06-26 09:34:27	2025-06-26 09:34:27
4	Design	design	\N	2025-06-26 09:34:27	2025-06-26 09:34:27
5	UI/UX	uiux	4	2025-06-26 09:34:27	2025-06-26 09:34:27
6	Graphic	graphic	4	2025-06-26 09:34:27	2025-06-26 09:34:27
7	Cars	cars	\N	2025-06-26 09:34:27	2025-06-26 09:34:27
8	Italian	italian	7	2025-06-26 09:34:27	2025-06-26 09:34:27
9	German	german	7	2025-06-26 09:34:27	2025-06-26 09:34:27
10	Czech	сzech	7	2025-06-26 09:34:27	2025-06-26 09:34:27
\.


--
-- Data for Name: category_translations; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.category_translations (id, category_id, locale, name, slug, created_at, updated_at) FROM stdin;
1	1	en	IT	it	2025-06-26 09:34:27	2025-06-26 09:34:27
2	1	ru	ИТ	it	2025-06-26 09:34:27	2025-06-26 09:34:27
3	2	en	Front-end	front	2025-06-26 09:34:27	2025-06-26 09:34:27
4	2	ru	Фронт	front	2025-06-26 09:34:27	2025-06-26 09:34:27
5	3	en	Back-end	back	2025-06-26 09:34:27	2025-06-26 09:34:27
6	3	ru	Бэк	back	2025-06-26 09:34:27	2025-06-26 09:34:27
7	4	en	Design	design	2025-06-26 09:34:27	2025-06-26 09:34:27
8	4	ru	Дизайн	design	2025-06-26 09:34:27	2025-06-26 09:34:27
9	5	en	UI/UX	uiux	2025-06-26 09:34:27	2025-06-26 09:34:27
10	6	en	Graphic	graphic	2025-06-26 09:34:27	2025-06-26 09:34:27
11	6	ru	Графика	graphic	2025-06-26 09:34:27	2025-06-26 09:34:27
12	7	en	Cars	cars	2025-06-26 09:34:27	2025-06-26 09:34:27
13	7	ru	Машины	cars	2025-06-26 09:34:27	2025-06-26 09:34:27
14	8	en	Italian	italian	2025-06-26 09:34:27	2025-06-26 09:34:27
15	8	ru	Итальянские	italian	2025-06-26 09:34:27	2025-06-26 09:34:27
16	9	en	German	german	2025-06-26 09:34:27	2025-06-26 09:34:27
17	9	ru	Немецкие	german	2025-06-26 09:34:27	2025-06-26 09:34:27
18	10	en	Czech	czech	2025-06-26 09:34:27	2025-06-26 09:34:27
19	10	ru	Чешские	czech	2025-06-26 09:34:27	2025-06-26 09:34:27
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2025_06_12_044638_create_user_posts_table	1
5	2025_06_19_035500_create_post_translations_table	1
6	2025_06_19_035941_migrate_titles_to_post_translations	1
7	2025_06_19_042403_drop_title_and_content_from_user_posts	1
8	2025_06_20_101802_create_category	1
9	2025_06_20_102034_add_category_id_to_user_posts	1
10	2025_06_23_052202_rename_user_posts_to_posts_table	1
11	2025_06_23_052925_rename_user_post_id_column_to_post_id_in_post_translations	1
12	2025_06_23_053830_create_post_categories	1
13	2025_06_23_054134_rename_category_post_to_post_categories	1
14	2025_06_23_060006_remove_category_id_from_posts	1
15	2025_06_23_062327_rename_language_to_locale_in_post_translations	1
16	2025_06_24_041007_create_category_translations_table	1
18	2025_06_30_062241_create_post_images_table	2
19	2025_06_30_063414_remove_image_link_from_posts_table	3
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: post_categories; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.post_categories (post_id, category_id) FROM stdin;
1	9
1	7
2	9
2	7
3	8
3	7
4	10
4	7
5	5
5	4
6	6
6	4
7	3
7	1
8	1
15	1
8	2
16	1
17	1
\.


--
-- Data for Name: post_images; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.post_images (id, post_id, name, is_cover, created_at, updated_at) FROM stdin;
1	1	posts/20250626_101105_rqXm1q.webp	t	2025-06-30 11:32:58	2025-06-30 11:32:58
2	2	posts/20250626_101359_A3WQRC.jpg	t	2025-06-30 11:32:58	2025-06-30 11:32:58
3	3	posts/20250626_101458_QX2mO5.jpg	t	2025-06-30 11:32:58	2025-06-30 11:32:58
4	4	posts/20250626_101538_R96ojW.jpg	t	2025-06-30 11:32:58	2025-06-30 11:32:58
5	5	posts/20250626_101730_2IWV7y.png	t	2025-06-30 11:32:58	2025-06-30 11:32:58
6	6	posts/20250626_101827_Bb8wbj.jpg	t	2025-06-30 11:32:58	2025-06-30 11:32:58
7	7	posts/20250626_102032_6cXp9N.png	t	2025-06-30 11:32:58	2025-06-30 11:32:58
45	17	posts/20250701_065814_GshPnE.png	f	2025-07-01 06:58:14	2025-07-01 06:58:14
20	15	posts/20250630_092634_tiJO7H.png	f	2025-06-30 09:26:34	2025-06-30 09:29:53
21	15	posts/20250630_092953_3dggvo.jpg	t	2025-06-30 09:29:53	2025-06-30 09:29:53
22	15	posts/20250630_093004_mEIzs1.jpg	f	2025-06-30 09:30:04	2025-06-30 09:30:04
23	15	posts/20250630_093004_t3BiWl.png	f	2025-06-30 09:30:04	2025-06-30 09:30:04
24	15	posts/20250630_093004_htipuT.jpg	f	2025-06-30 09:30:04	2025-06-30 09:30:04
25	15	posts/20250630_093004_vvarLi.png	f	2025-06-30 09:30:04	2025-06-30 09:30:04
26	15	posts/20250630_093004_dFqPOa.jpg	f	2025-06-30 09:30:04	2025-06-30 09:30:04
27	15	posts/20250630_093004_l4x8Fu.jpg	t	2025-06-30 09:30:04	2025-06-30 09:30:04
46	17	posts/20250701_065814_UlFGq0.jpg	f	2025-07-01 06:58:14	2025-07-01 06:58:14
47	17	posts/20250701_065814_wqqpSr.png	f	2025-07-01 06:58:14	2025-07-01 06:58:14
48	17	posts/20250701_065815_ca1wCL.jpg	f	2025-07-01 06:58:15	2025-07-01 06:58:15
49	17	posts/20250701_065815_ZgXAki.jpg	f	2025-07-01 06:58:15	2025-07-01 06:58:15
50	17	posts/20250701_065815_t5Mw14.png	f	2025-07-01 06:58:15	2025-07-01 06:58:15
51	17	posts/20250701_065815_cH13Iq.png	f	2025-07-01 06:58:15	2025-07-01 06:58:15
44	17	posts/20250701_065814_1eKlvU.jpg	t	2025-07-01 06:58:14	2025-07-01 06:58:15
40	16	posts/20250701_062009_h9HZv3.png	t	2025-07-01 06:20:09	2025-07-01 06:20:09
37	8	posts/20250701_050315_e49VxU.jpg	t	2025-07-01 05:03:15	2025-07-01 06:23:51
\.


--
-- Data for Name: post_translations; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.post_translations (id, post_id, locale, title, content, created_at, updated_at) FROM stdin;
1	1	ru	БМВ	Немецкая автомобильная компания, один из крупнейших автопроизводителей мира. Штаб-квартира находится в Мюнхене, Германия. Заняла 46-е место в списке Forbes Global 2000 и 57-е место в списке Fortune Global 500 в 2023 году. Также компания находится на 9 месте в списках «Лучшие работодатели мира» (2023) и «Лучшие работодатели Америки по штатам» (2023). На текущий момент специализируется на производстве различных легковых и спортивных автомобилей, внедорожников и мотоциклов. Несмотря на то что сегодня компания в первую очередь узнаваема своими автомобилями, её история начинается с производства авиационных двигателей.	2025-06-26 10:11:06	2025-06-26 10:11:06
2	2	ru	Мерседес	Мерседес – одно из тех слов, которое не требует перевода или объяснения, буквально, весь мир знает этот выдающийся автомобильный бренд. Mercedes-Benz – один из многих немецких автоконцернов, специализирующихся на выпуске автомобилей легкового, грузового типов, а также автобусов и другой автотехники. Образованный в конце 19 века, автоконцерн Mercedes-Benz сегодня имеет многомиллионный ежегодный доход и оценивается более чем в 30 миллиардов долларов. Автомобили Мерседес пользуются огромной популярностью в России, в частности, Мерседес Вито имеет наибольшую востребовательность, по сравнению с другими фургонами иных марок. Выпущенный в 1995 году в испанском городке Виктория на базе завода компании DaimlerChrysler, фургон V-класса Vito уже спустя год заработал звание – «фургон года».	2025-06-26 10:13:59	2025-06-26 10:13:59
3	3	ru	Альфа Ромео	Alfa Romeo, сокращённо Alfa, — итальянский производитель автомобилей класса «премиум». Компания была основана французским инженером-предпринимателем Александром Дарраком под именем A.L.F.A. (Anonima Lombarda Fabbrica Automobili) 24 июня 1910 года в Милане. В основании компании приняли участие итальянские инженеры, такие как Уго Стелла и Никола Ромео. Начиная со своего основания, Alfa Romeo принимала участие в автогонках. В 1911 году A.L.F.A. участвовали в гонке Targa Florio с пилотами Франкини (Franchini) и Ронцони (Ronzoni) на двух моделях A.L.F.A. 24 HP.Alfa Romeo успешно выступала во множестве значимых автомобильных гоночных турнирах и чемпионатах, включая гонки серии Гран-при, Формулу-1, спортивные гонки серии ИндиКар, кольцевые автогонки серии Touring и в раллийных гонках.	2025-06-26 10:15:01	2025-06-26 10:15:01
4	4	ru	Шкода	Škoda Auto (Škoda) – крупный чешский автопроизводитель, основанный в 1895 году как Laurin & Klement, а с 1925 года входящий в состав промышленного конгломерата Škoda. Сегодня Škoda является частью Volkswagen Group и известна своим сочетанием надежности, доступности и современного дизайна. Компания специализируется на производстве автомобилей различных типов кузовов, таких как седаны, хэтчбеки и универсалы.	2025-06-26 10:15:38	2025-06-26 10:15:38
5	5	ru	Эффект обманутого ожидания в дизайне	Привет, народ! Я Оксана Артемьева, UX/UI дизайнер. Недавно наткнулась в литературе на термин «эффект обманутого ожидания» — средство усиления выразительности текста, основанное на нарушении предположений, ожиданий и предчувствий читателя. Это то, что усиливает текст, делает его лучше, хотя сам термин звучит максимально негативно.\r\n\r\nЯ начала копать дальше и выяснила, что с эффектом обманутого ожидания мы регулярно сталкиваемся в психологической плоскости. Например, рассчитываем на что-то одно, а потом видим реальность, и вот — наши ожидания не оправдались. Так случается, когда трейлер фильма или сериала обещает захватывающий сюжет и яркие сцены, а сам фильм оказывается скучным или неинтересным. Вы покупаете новый гаджет или одежду, основываясь на ярких рекламных материалах и отзывах, но получаете продукт низкого качества, это вызывает разочарование. И это уже что-то негативное. А как насчет термина «эффект обманутого ожидания» в дизайне?	2025-06-26 10:17:30	2025-06-26 10:17:30
11	6	en	Business breakfast for designers at the AGIMA office — let's discuss the integration of AI into interfaces	AI is increasingly becoming part of user interfaces, especially in professional and corporate products, where it is used to increase productivity. If three years ago AI worked “under the hood,” now businesses expect it to be of real use in work processes.\r\nFor AI to really help, it needs to be organically integrated into the user experience. Practice shows that the best solutions are those where AI acts as an assistant and solves problems together with a person. This approach changes the very nature of interaction and forms a new space of user interfaces.\r\n\r\nBut this area does not yet have established patterns — we are all in search.\r\n\r\nAt the business breakfast, we will discuss:\r\n\r\n– how the interface landscape has changed with the advent of LLM and AI agents;\r\n– what approaches to AI integration already exist;\r\n– how to combine new AI capabilities with the traditional HCD approach.	2025-06-26 10:42:19	2025-06-26 10:42:19
6	6	ru	Бизнес-завтрак для дизайнеров в офисе AGIMA — обсудим интеграцию ИИ в интерфейсы	ИИ всё чаще становится частью пользовательских интерфейсов — особенно в профессиональных и корпоративных продуктах, где на него делают ставку для повышения продуктивности. Если еще три года назад ИИ работал «под капотом», то теперь бизнес ожидает от него реальной пользы в рабочих процессах.\r\nЧтобы ИИ действительно помогал, его нужно органично встроить в пользовательский опыт. Практика показывает: лучшие решения — те, где ИИ выступает помощником и решает задачи совместно с человеком. Такой подход меняет саму природу взаимодействия и формирует новое пространство пользовательских интерфейсов.\r\n\r\nНо эта область пока не имеет устоявшихся паттернов — мы все находимся в поиске.\r\n\r\nНа бизнес-завтраке обсудим:\r\n\r\n– как изменился ландшафт интерфейсов с приходом LLM и ИИ-агентов;\r\n– какие подходы к ИИ-интеграции уже существуют;\r\n– как сочетать новые возможности ИИ с традиционным HCD-подходом.	2025-06-26 10:18:27	2025-06-26 10:18:27
7	7	ru	PVS-Studio 7.36: расширение поддержки MISRA, плагин для Qt Creator 16, расширение пользовательских аннотаций в C#	Вышел новый релиз PVS-Studio — 7.36. Встречайте расширение поддержки MISRA, плагин для Qt Creator 16, расширение пользовательских аннотаций в C# и ещё много других обновлений! Больше подробностей в этой заметке.\r\nВыбор версии стандартов MISRA C и MISRA C++\r\n\r\nВ C и C++ анализаторе PVS-Studio была добавлена возможность задать версии стандартов MISRA C и MISRA C++. Выбрать используемую версию стандарта можно в настройках PVS-Studio плагина для Visual Studio.\r\n\r\nПоддерживаемые версии стандартов: MISRA C 2012, MISRA C 2023, MISRA C++ 2008 и MISRA C++ 2023.\r\n\r\nРасширение механизма пользовательских аннотаций в C#\r\n\r\nВ C# анализаторе был расширен механизм пользовательских аннотаций. До этого пользователи могли создавать аннотации только для taint-анализа.\r\n\r\nВ анализаторе существует ряд аннотаций для taint-анализа. С их помощью можно размечать источники и приёмники заражения. Также можно помечать методы/конструкторы, которые производят валидацию taint-данных. Таким образом, если taint-данные прошли валидацию, то при их попадании в приёмник анализатор не выдаст предупреждение.\r\n\r\nТеперь появилась возможность с помощью пользовательских аннотаций указать анализатору информацию, которая необходима не только для taint-анализа. Например, можно указать, что метод может вернуть null, что возвращаемое значение метода нужно использовать или что аргумент метода не должен быть равен null, и ещё много чего.	2025-06-26 10:20:32	2025-06-26 10:20:32
8	8	ru	Яндекс.Практикум запустил курс «React-разработчик»	Сервис онлайн-образования Яндекс.Практикум запустил курс «React-разработчик» — двухмесячный интенсив для погружения в экосистему React, работы с популярными технологиями и изучения их альтернатив. Курс подойдёт тем, кто уже умеет верстать и знает основы JavaScript.\r\n\r\nВыпускники получат сертификат — официальный документ о дополнительном образовании.\r\nReact-разработчик — специалист, который создаёт приложения на React и использует дополнительные инструменты: Redux, TypeScript, Jest. На курсе вы за два месяца разберётесь в этом стеке технологий.\r\n\r\nС первого дня студенты учатся на практике в собственной среде обучения: мы даём знания небольшими частями, которые нужно сразу применить, написав собственный код в онлайн-тренажёре.	2025-06-26 10:21:45	2025-06-26 10:21:45
9	8	en	Yandex.Practicum Launches React Developer Course	Online education service Yandex.Practicum has launched the course "React Developer" - a two-month intensive course for immersion in the React ecosystem, working with popular technologies and studying their alternatives. The course is suitable for those who already know how to layout and the basics of JavaScript.\r\n\r\nGraduates will receive a certificate - an official document on additional education.\r\nReact developer - a specialist who creates applications on React and uses additional tools: Redux, TypeScript, Jest. On the course, you will understand this stack of technologies in two months.\r\n\r\nFrom the first day, students learn in practice in their own learning environment: we impart knowledge in small parts that need to be immediately applied by writing your own code in the online simulator.	2025-06-26 10:24:23	2025-06-26 10:24:47
10	7	en	PVS-Studio 7.36: MISRA support extension, Qt Creator 16 plugin, custom annotations extension in C#	A new release of PVS-Studio has been released — 7.36. Meet the MISRA support extension, a plugin for Qt Creator 16, an extension of custom annotations in C#, and many other updates! More details in this note.\r\nSelecting the version of MISRA C and MISRA C++ standards\r\n\r\nThe ability to specify the versions of the MISRA C and MISRA C++ standards has been added to the PVS-Studio C and C++ analyzer. You can select the version of the standard to use in the settings of the PVS-Studio plugin for Visual Studio.\r\n\r\nSupported versions of the standards: MISRA C 2012, MISRA C 2023, MISRA C++ 2008, and MISRA C++ 2023.\r\n\r\nExtension of the custom annotation mechanism in C#\r\n\r\nThe custom annotation mechanism has been expanded in the C# analyzer. Previously, users could only create annotations for taint analysis.\r\n\r\nThe analyzer has a number of annotations for taint analysis. They can be used to mark sources and receivers of infection. You can also mark methods/constructors that validate taint data. Thus, if taint data has been validated, the analyzer will not issue a warning when it gets to the receiver.\r\n\r\nNow it is possible to use custom annotations to indicate to the analyzer information that is necessary not only for taint analysis. For example, you can specify that a method can return null, that the return value of the method should be used, or that the method argument should not be null, and much more.	2025-06-26 10:41:45	2025-06-26 10:41:45
12	5	en	The effect of disillusioned expectations in design	Hello, people! I am Oksana Artemyeva, UX/UI designer. Recently I came across the term “the effect of deceived expectations” in literature — a means of enhancing the expressiveness of the text, based on the violation of the assumptions, expectations and premonitions of the reader. This is what strengthens the text, makes it better, although the term itself sounds extremely negative.\r\n\r\nI started digging further and found out that we regularly encounter the effect of deceived expectations in the psychological plane. For example, we expect one thing, and then we see reality, and here it is — our expectations are not met. This happens when the trailer for a movie or TV series promises a gripping plot and bright scenes, but the movie itself turns out to be boring or uninteresting. You buy a new gadget or clothes based on bright advertising materials and reviews, but you receive a low-quality product, this causes disappointment. And this is already something negative. And what about the term “effect of deceived expectations” in design?	2025-06-26 10:42:49	2025-06-26 10:42:49
13	4	en	Škoda	Škoda Auto (Škoda) is a major Czech car manufacturer, founded in 1895 as Laurin & Klement, and since 1925 part of the Škoda industrial conglomerate. Today, Škoda is part of the Volkswagen Group and is known for its combination of reliability, affordability and modern design. The company specializes in the production of cars of various body types, such as sedans, hatchbacks and station wagons.	2025-06-26 10:43:11	2025-06-26 10:43:11
14	3	en	Alfa Romeo	Alfa Romeo, abbreviated as Alfa, is an Italian manufacturer of premium automobiles. The company was founded by the French engineer and entrepreneur Alexandre Darracq under the name A.L.F.A. (Anonima Lombarda Fabbrica Automobili) on June 24, 1910 in Milan. Italian engineers such as Ugo Stella and Nicola Romeo took part in the founding of the company. Since its foundation, Alfa Romeo has participated in auto racing. In 1911, A.L.F.A. participated in the Targa Florio race with drivers Franchini and Ronzoni in two A.L.F.A. 24 HP models. Alfa Romeo has successfully competed in many important automobile racing tournaments and championships, including Grand Prix racing, Formula 1, IndyCar racing, Touring car racing and rally racing.	2025-06-26 10:43:30	2025-06-26 10:43:30
15	2	en	Mercedes-Benz	Mercedes is one of those words that does not require translation or explanation, literally, the whole world knows this outstanding automobile brand. Mercedes-Benz is one of many German automakers specializing in the production of passenger cars, trucks, buses and other vehicles. Founded in the late 19th century, the Mercedes-Benz automaker today has a multi-million annual income and is estimated at more than 30 billion dollars. Mercedes cars are very popular in Russia, in particular, the Mercedes Vito is in the greatest demand, compared to other vans of other brands. Released in 1995 in the Spanish town of Victoria on the basis of the DaimlerChrysler plant, the V-class Vito van earned the title of "van of the year" a year later.	2025-06-26 10:43:59	2025-06-26 10:43:59
16	1	en	Bayerisch Motoren Werke AG (BMW AG)	A German automobile company, one of the largest automakers in the world. Headquartered in Munich, Germany. Ranked 46th on the Forbes Global 2000 list and 57th on the Fortune Global 500 list in 2023. The company is also ranked 9th on the lists of "World's Best Employers" (2023) and "America's Best Employers by State" (2023). Currently, it specializes in the production of various passenger cars, sports cars, SUVs, and motorcycles. Although today the company is primarily recognized for its cars, its history begins with the production of aircraft engines.	2025-06-26 10:44:33	2025-06-26 10:44:33
17	15	en	asdf	asdf	2025-06-30 09:26:35	2025-06-30 09:26:35
18	16	ru	asdff	asdf	2025-07-01 06:20:09	2025-07-01 06:20:09
19	17	en	фыва	фвыафыв	2025-07-01 06:58:15	2025-07-01 06:58:15
\.


--
-- Data for Name: posts; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.posts (id, user_id, is_published, created_at, updated_at, deleted_at) FROM stdin;
1	3	t	2025-06-26 10:11:05	2025-06-26 10:11:05	\N
2	3	t	2025-06-26 10:13:59	2025-06-26 10:13:59	\N
3	2	t	2025-06-26 10:14:58	2025-06-26 10:14:58	\N
4	2	t	2025-06-26 10:15:38	2025-06-26 10:15:38	\N
5	2	t	2025-06-26 10:17:30	2025-06-26 10:17:30	\N
6	2	t	2025-06-26 10:18:27	2025-06-26 10:18:27	\N
7	1	t	2025-06-26 10:20:32	2025-06-26 10:20:32	\N
8	1	t	2025-06-26 10:21:45	2025-06-26 10:21:45	\N
15	1	t	2025-06-30 09:26:34	2025-06-30 09:37:05	2025-06-30 09:37:05
16	1	t	2025-07-01 06:20:09	2025-07-01 06:20:14	2025-07-01 06:20:14
17	1	t	2025-07-01 06:58:14	2025-07-01 06:58:19	2025-07-01 06:58:19
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
5hVLWymY73ipsxaVxc5JnLunVerTPST3TyiQzhgC	1	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36	YTo1OntzOjY6Il90b2tlbiI7czo0MDoib01PbUxYVzdRTzl5ano4UW40dU9jUEVpQWE1SmtQQ21Bc2dTQXlQMCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3N0cy84Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9	1751357523
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: admin
--

COPY public.users (id, user_name, password, first_name, last_name, email, sex, is_admin, created_at, updated_at, deleted_at) FROM stdin;
1	admin	$2y$12$e5oVY1Y/W70u4aWC3W1PL.Hvv606IhQ3NeDq4xHIVsmhd0i5jhBJe	Admin	Adminov	nagibatordier@gmail.com	male	t	2025-06-26 09:49:19	2025-06-26 09:49:19	\N
2	user	$2y$12$8Fj7Ubxn/7BzesQiyrgZCeq08q9KsPFS7Q3DBTellkyEqd4xoURb2	Диёр	Рустамов	drustamov695@gmail.com	male	f	2025-06-26 10:07:00	2025-06-26 10:07:00	\N
3	user123	$2y$12$lEmCeZJIStX0z7ZKT.3XLuYpqOWK.jQ9BZj3TNkx6Z30c1lJsGYbK	user	user	rustamovadinara@gmail.com	female	f	2025-06-26 10:07:21	2025-06-26 10:07:21	\N
\.


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.categories_id_seq', 10, true);


--
-- Name: category_translations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.category_translations_id_seq', 19, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.migrations_id_seq', 19, true);


--
-- Name: post_images_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.post_images_id_seq', 51, true);


--
-- Name: post_translations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.post_translations_id_seq', 19, true);


--
-- Name: user_posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.user_posts_id_seq', 17, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: admin
--

SELECT pg_catalog.setval('public.users_id_seq', 3, true);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: categories categories_slug_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_slug_unique UNIQUE (slug);


--
-- Name: post_categories category_post_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_categories
    ADD CONSTRAINT category_post_pkey PRIMARY KEY (post_id, category_id);


--
-- Name: category_translations category_translations_category_id_locale_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.category_translations
    ADD CONSTRAINT category_translations_category_id_locale_unique UNIQUE (category_id, locale);


--
-- Name: category_translations category_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.category_translations
    ADD CONSTRAINT category_translations_pkey PRIMARY KEY (id);


--
-- Name: category_translations category_translations_slug_locale_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.category_translations
    ADD CONSTRAINT category_translations_slug_locale_unique UNIQUE (slug, locale);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: post_images post_images_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_images
    ADD CONSTRAINT post_images_pkey PRIMARY KEY (id);


--
-- Name: post_translations post_translations_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_translations
    ADD CONSTRAINT post_translations_pkey PRIMARY KEY (id);


--
-- Name: post_translations post_translations_user_post_id_language_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_translations
    ADD CONSTRAINT post_translations_user_post_id_language_unique UNIQUE (post_id, locale);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: posts user_posts_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT user_posts_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_user_name_unique; Type: CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_user_name_unique UNIQUE (user_name);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: admin
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: categories categories_parent_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_parent_id_foreign FOREIGN KEY (parent_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- Name: post_categories category_post_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_categories
    ADD CONSTRAINT category_post_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- Name: post_categories category_post_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_categories
    ADD CONSTRAINT category_post_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON DELETE CASCADE;


--
-- Name: category_translations category_translations_category_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.category_translations
    ADD CONSTRAINT category_translations_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- Name: post_images post_images_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_images
    ADD CONSTRAINT post_images_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON DELETE CASCADE;


--
-- Name: post_translations post_translations_user_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.post_translations
    ADD CONSTRAINT post_translations_user_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON DELETE CASCADE;


--
-- Name: posts user_posts_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: admin
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT user_posts_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

