# Technisch Ontwerp – Programmeeromgeving

## Architectuur

De applicatie wordt ontwikkeld als een webapplicatie volgens het MVC(Model ,View, Controller)-principe van Laravel.

### Front-end
- Vue.js
- TailwindCSS

### Back-end
- Laravel
- PHP

### Database
- MySQL
- phpMyAdmin

### Versiebeheer
- GitHub

---

# Systeemoverzicht

```text
Gebruiker
    │
    ▼
Vue Front-end
    │
    ▼
Laravel Controllers
    │
    ▼
Laravel Models
    │
    ▼
MySQL Database
```

De gebruiker communiceert met de Vue-interface. Laravel verwerkt de aanvragen en haalt gegevens op uit de database.

---

# Databaseontwerp

## users

Slaat gebruikersgegevens op.

| Kolom | Type |
|---------|---------|
| id | BIGINT PK |
| username | VARCHAR |
| email | VARCHAR |
| password | VARCHAR |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

---

## programming_languages

Programmeertalen binnen het platform.

| Kolom | Type |
|---------|---------|
| id | BIGINT PK |
| name | VARCHAR |
| description | TEXT |
| icon | VARCHAR |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

Voorbeelden:
- PHP
- JavaScript
- Python
- C++

---

## lessons

Lessen binnen een programmeertaal.

| Kolom | Type |
|---------|---------|
| id | BIGINT PK |
| language_id | BIGINT FK |
| title | VARCHAR |
| description | TEXT |
| content | LONGTEXT |
| lesson_order | INT |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

---

## quizzes

Quiz gekoppeld aan een les.

| Kolom | Type |
|---------|---------|
| id | BIGINT PK |
| lesson_id | BIGINT FK |
| title | VARCHAR |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

---

## questions

Quizvragen.

| Kolom | Type |
|---------|---------|
| id | BIGINT PK |
| quiz_id | BIGINT FK |
| question | TEXT |
| explanation | TEXT |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

---

## answers

Antwoordmogelijkheden.

| Kolom | Type |
|---------|---------|
| id | BIGINT PK |
| question_id | BIGINT FK |
| answer_text | TEXT |
| is_correct | BOOLEAN |
| created_at | TIMESTAMP |
| updated_at | TIMESTAMP |

---

## user_lesson_progress

Voortgang van lessen.

| Kolom | Type |
|---------|---------|
| id | BIGINT PK |
| user_id | BIGINT FK |
| lesson_id | BIGINT FK |
| completed | BOOLEAN |
| completed_at | DATETIME |

---

## user_quiz_results

Resultaten van quizzen.

| Kolom | Type |
|---------|---------|
| id | BIGINT PK |
| user_id | BIGINT FK |
| quiz_id | BIGINT FK |
| score | INT |
| max_score | INT |
| completed_at | DATETIME |

---

# ERD

## Vereenvoudigde ERD

```text
users
│
├──< user_lesson_progress >── lessons
│                               │
│                               ▼
│                     programming_languages
│
└──< user_quiz_results >── quizzes
                                │
                                ▼
                            questions
                                │
                                ▼
                             answers
```

## Uitgebreide ERD

```text
programming_languages
        │
        │ 1:N
        ▼
     lessons
        │
        │ 1:N
        ▼
     quizzes
        │
        │ 1:N
        ▼
    questions
        │
        │ 1:N
        ▼
     answers


users
   │
   ├───────────────┐
   │               │
   ▼               ▼

user_lesson_progress
        │
        ▼
      lessons

user_quiz_results
        │
        ▼
      quizzes
```

---

# Laravel Structuur

## Models

```text
User
ProgrammingLanguage
Lesson
Quiz
Question
Answer
UserLessonProgress
UserQuizResult
```

## Controllers

```text
AuthController
DashboardController
LanguageController
LessonController
QuizController
ProfileController
```

## Vue Pagina's

```text
LoginPage.vue
RegisterPage.vue
DashboardPage.vue
LanguagePage.vue
LessonPage.vue
QuizPage.vue
ProfilePage.vue
```

---

# API Routes

```php
POST   /register
POST   /login

GET    /languages

GET    /lessons/{id}

GET    /quiz/{id}

POST   /quiz/submit

GET    /profile

POST   /progress/update
```

---

# Relaties

| Tabel | Relatie | Tabel |
|---------|---------|---------|
| programming_languages | 1:N | lessons |
| lessons | 1:N | quizzes |
| quizzes | 1:N | questions |
| questions | 1:N | answers |
| users | N:M | lessons |
| users | N:M | quizzes |

---

# Motivatie

Er is gekozen voor een gescheiden structuur van programmeertalen, lessen, quizzen en voortgang zodat nieuwe content eenvoudig toegevoegd kan worden zonder de database aan te passen.

Daarnaast maakt deze structuur toekomstige uitbreidingen mogelijk zoals:

- XP-systeem
- Badges
- Achievements
- Leaderboards
- Dagelijkse uitdagingen
- Meerdere programmeertalen

Hierdoor blijft de applicatie schaalbaar en onderhoudbaar.