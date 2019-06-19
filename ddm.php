CREATE TABLE "expense_heads" (
"id" integer not null primary key autoincrement,
"user_id" integer not null,
"title" varchar not null,
"description" text null,
"created_at" datetime null,
"updated_at" datetime null,
foreign key("user_id") references "users"("id") on delete CASCADE)
