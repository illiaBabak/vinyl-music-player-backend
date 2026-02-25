# 🎵 Vinyl Music Player PHP Backend

<div align="center">

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MongoDB](https://img.shields.io/badge/MongoDB-4EA94B?style=for-the-badge&logo=mongodb&logoColor=white)
![Supabase](https://img.shields.io/badge/Supabase-3ECF8E?style=for-the-badge&logo=supabase&logoColor=white)

**Backend pet project for learning PHP, the MVC pattern, MongoDB, and Supabase storage integration.**

</div>

---

## 📖 About

**Goal of the project** – to practice on a real example:

- **Plain PHP** without frameworks
- The **MVC pattern** (controllers, models, core layer)
- **MongoDB** and the official PHP driver
- Integration with **Supabase Storage** (signed URLs for secure audio file access)

The app implements a simple vinyl music player backend: managing tracks and providing signed URLs for audio playback from Supabase storage.

---

## ✨ Main Features

- **Track management**:
  - Get all tracks from MongoDB
  - Track metadata (audio path, preview path, etc.)
- **Supabase Storage**:
  - Signed URLs for secure access to audio files
  - Signed URLs for preview images
  - Custom implementation via cURL (no heavy SDK dependencies)
- **MongoDB**:
  - Work with `tracks` collection
- **CORS**:
  - Configured for frontend (e.g. React app on `localhost:3000`)
- **REST-style API**:
  - JSON responses with unified format (`data` / `error`)

---

## 🛠 Tech Stack (Short)

- **Backend**: PHP 8.x (CLI dev server)
- **Architecture**: custom **MVC** (controllers / models / core / services)
- **Database**: MongoDB
- **Storage**: Supabase Storage (signed URLs)
- **Dependencies**: Composer (`mongodb/mongodb`, `vlucas/phpdotenv`, `supabase/storage-php`)
- **Entry point**: `public/index.php`

---

## 📁 Project Structure (Short)

```text
public/
  index.php          # entry point, CORS, router, Mongo connection

core/
  Router.php         # simple router (URL → controller@method)
  Mongo.php          # MongoDB connection (Client, Database)
  Response.php       # building HTTP responses (json, error)

app/
  Controllers/
    TracksController.php
  Models/
    TracksModel.php  # work with tracks collection
  Services/
    SupabaseSignedUrl.php  # Supabase signed URL generation

vendor/              # Composer dependencies
README.md
```

---

## ⚙️ Environment Configuration

Create a `.env` file in the project root (next to `composer.json`):

```env
MONGO_URI=mongodb+srv://username:password@cluster.example.mongodb.net/?retryWrites=true&w=majority
MONGO_DB=vinyl-music-player

SUPABASE_URL=https://your-project.supabase.co
SUPABASE_API_KEY=your_supabase_anon_key
SUPABASE_REFERENCE_ID=your_project_reference_id
```

---

## 🚀 Running the Project

```bash
composer install
composer serve
```

API will be available at `http://localhost:8000`.
