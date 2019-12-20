/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : PostgreSQL
 Source Server Version : 90616
 Source Host           : localhost:5432
 Source Catalog        : event
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 90616
 File Encoding         : 65001

 Date: 20/12/2019 13:49:34
*/


-- ----------------------------
-- Sequence structure for migrations_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."migrations_id_seq";
CREATE SEQUENCE "public"."migrations_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Table structure for attendances
-- ----------------------------
DROP TABLE IF EXISTS "public"."attendances";
CREATE TABLE "public"."attendances" (
  "id" uuid NOT NULL,
  "event_id" uuid,
  "participant_id" uuid,
  "status" bool,
  "userid_created" uuid,
  "userid_updated" uuid,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS "public"."categories";
CREATE TABLE "public"."categories" (
  "id" uuid NOT NULL,
  "code" varchar(255) COLLATE "pg_catalog"."default",
  "name" varchar(255) COLLATE "pg_catalog"."default",
  "description" text COLLATE "pg_catalog"."default",
  "userid_created" uuid,
  "userid_updated" uuid,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Table structure for event_type
-- ----------------------------
DROP TABLE IF EXISTS "public"."event_type";
CREATE TABLE "public"."event_type" (
  "event_id" uuid,
  "type_id" uuid
)
;

-- ----------------------------
-- Table structure for events
-- ----------------------------
DROP TABLE IF EXISTS "public"."events";
CREATE TABLE "public"."events" (
  "id" uuid NOT NULL,
  "code" varchar(255) COLLATE "pg_catalog"."default",
  "unit_id" uuid,
  "type_id" uuid,
  "category_id" uuid,
  "title" varchar(255) COLLATE "pg_catalog"."default",
  "theme" text COLLATE "pg_catalog"."default",
  "place" varchar(255) COLLATE "pg_catalog"."default",
  "date" date,
  "times" varchar(100) COLLATE "pg_catalog"."default",
  "quota" int2,
  "pamphlet" varchar(255) COLLATE "pg_catalog"."default",
  "start_reg" date,
  "end_reg" date,
  "publication_status" bool,
  "pay_status" bool,
  "start_pay" date,
  "end_pay" date,
  "bank_name" varchar(255) COLLATE "pg_catalog"."default",
  "bank_number" varchar(32) COLLATE "pg_catalog"."default",
  "bank_owner" varchar(255) COLLATE "pg_catalog"."default",
  "cost" int4,
  "userid_created" uuid,
  "userid_updated" uuid,
  "created_at" timestamp(6),
  "updated_at" timestamp(6),
  "description" text COLLATE "pg_catalog"."default",
  "slug" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS "public"."migrations";
CREATE TABLE "public"."migrations" (
  "id" int4 NOT NULL DEFAULT nextval('migrations_id_seq'::regclass),
  "migration" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "batch" int4 NOT NULL
)
;

-- ----------------------------
-- Table structure for participants
-- ----------------------------
DROP TABLE IF EXISTS "public"."participants";
CREATE TABLE "public"."participants" (
  "id" uuid NOT NULL,
  "event_id" uuid,
  "user_id" uuid,
  "is_valid" int2,
  "userid_created" uuid,
  "userid_updated" uuid,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS "public"."password_resets";
CREATE TABLE "public"."password_resets" (
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "token" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "created_at" timestamp(0)
)
;

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS "public"."payments";
CREATE TABLE "public"."payments" (
  "id" uuid NOT NULL,
  "event_id" uuid,
  "participant_id" uuid,
  "bank_sender" varchar(255) COLLATE "pg_catalog"."default",
  "bank_owner" varchar(255) COLLATE "pg_catalog"."default",
  "total" int4,
  "pay_status" bool,
  "userid_created" uuid,
  "userid_updated" uuid,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Table structure for types
-- ----------------------------
DROP TABLE IF EXISTS "public"."types";
CREATE TABLE "public"."types" (
  "id" uuid,
  "code" varchar(255) COLLATE "pg_catalog"."default",
  "name" varchar(255) COLLATE "pg_catalog"."default",
  "description" text COLLATE "pg_catalog"."default",
  "userid_created" uuid,
  "userid_updated" uuid,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Table structure for units
-- ----------------------------
DROP TABLE IF EXISTS "public"."units";
CREATE TABLE "public"."units" (
  "id" uuid NOT NULL,
  "code" varchar(255) COLLATE "pg_catalog"."default",
  "name" varchar(255) COLLATE "pg_catalog"."default",
  "description" text COLLATE "pg_catalog"."default",
  "shortname" varchar(255) COLLATE "pg_catalog"."default",
  "userid_created" uuid,
  "userid_updated" uuid,
  "created_at" timestamp(6),
  "updated_at" timestamp(6)
)
;

-- ----------------------------
-- Table structure for userdetails
-- ----------------------------
DROP TABLE IF EXISTS "public"."userdetails";
CREATE TABLE "public"."userdetails" (
  "id" uuid NOT NULL,
  "user_id" uuid,
  "fakultas" varchar COLLATE "pg_catalog"."default",
  "prodi" varchar(150) COLLATE "pg_catalog"."default",
  "phone" varchar(30) COLLATE "pg_catalog"."default",
  "origin" varchar(150) COLLATE "pg_catalog"."default",
  "userid_created" uuid,
  "userid_updated" uuid,
  "created_at" timestamp(6),
  "updated_at" timestamp(6),
  "noidentitas" varchar(100) COLLATE "pg_catalog"."default",
  "type" varchar(50) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "id" uuid NOT NULL,
  "name" varchar(255) COLLATE "pg_catalog"."default" NOT NULL DEFAULT ''::character varying,
  "email" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "email_verified_at" timestamp(0),
  "password" varchar(255) COLLATE "pg_catalog"."default" NOT NULL,
  "remember_token" varchar(100) COLLATE "pg_catalog"."default",
  "created_at" timestamp(0),
  "updated_at" timestamp(0),
  "role" varchar(100) COLLATE "pg_catalog"."default",
  "login_type" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."migrations_id_seq"
OWNED BY "public"."migrations"."id";
SELECT setval('"public"."migrations_id_seq"', 4, true);

-- ----------------------------
-- Primary Key structure for table attendances
-- ----------------------------
ALTER TABLE "public"."attendances" ADD CONSTRAINT "attendances_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table categories
-- ----------------------------
ALTER TABLE "public"."categories" ADD CONSTRAINT "categories_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table events
-- ----------------------------
ALTER TABLE "public"."events" ADD CONSTRAINT "events_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table migrations
-- ----------------------------
ALTER TABLE "public"."migrations" ADD CONSTRAINT "migrations_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table participants
-- ----------------------------
ALTER TABLE "public"."participants" ADD CONSTRAINT "participant_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table password_resets
-- ----------------------------
CREATE INDEX "password_resets_email_index" ON "public"."password_resets" USING btree (
  "email" COLLATE "pg_catalog"."default" "pg_catalog"."text_ops" ASC NULLS LAST
);

-- ----------------------------
-- Primary Key structure for table payments
-- ----------------------------
ALTER TABLE "public"."payments" ADD CONSTRAINT "payments_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table units
-- ----------------------------
ALTER TABLE "public"."units" ADD CONSTRAINT "units_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table userdetails
-- ----------------------------
ALTER TABLE "public"."userdetails" ADD CONSTRAINT "userdetails_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_email_key" UNIQUE ("email");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey1" PRIMARY KEY ("id");
