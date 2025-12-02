# LocateIT 📍

**LocateIT** is a comprehensive digital solution designed to modernize and streamline lost and found procedures within academic institutions. By transitioning from fragmented manual reporting systems to a centralized web-based platform, LocateIT enhances the efficiency of item recovery for students, faculty, and staff. 

This application provides a secure and accessible environment where members of the campus community can report missing belongings, document found items, and collaborate to ensure property is returned to its rightful owner. Through its intuitive interface, robust search capabilities, and campus-specific filtering, LocateIT fosters a community-driven approach to resolving lost property cases, ultimately reducing administrative overhead and cultivating a culture of honesty and support across the campus.

---

## 👥 Meet the Team

This project was passionately developed by:

* **De Castro, Angel Lyka**
* **Mercado, Klaine**
* **Niepes, Marc Vergel**

---

## 🚀 Key Features

* **Centralized Feed**: A real-time, dynamic feed displaying all reported lost and found items in one accessible location.
* **Advanced Filtering**: sophisticated filtering options allowing users to sort posts by **Campus** (e.g., Alangilan, Pablo Borbon, Lipa), **Category** (Gadgets, Documents, etc.), and **Date** to narrow down search results effectively.
* **Intelligent Search**: A robust search engine enabling users to quickly locate items based on keywords, descriptions, or specific locations.
* **Community Interaction**: Features such as **Upvoting** to increase visibility of urgent posts and a **Comment System** to facilitate communication between finders and owners.
* **Resolution Tracking**: A status management system allowing users to mark items as **Resolved** once they have been successfully recovered, keeping the feed current.
* **Secure Authentication**: Integrated user registration and authentication via Laravel Breeze to ensure accountability and trust within the platform.
* **Responsive User Interface**: A modern, mobile-responsive design built with Tailwind CSS, ensuring a seamless experience across all devices.

## 🛠️ Tech Stack

* **Backend Framework**: [Laravel](https://laravel.com/) (PHP)
* **Frontend**: Blade Templating Engine, [Tailwind CSS](https://tailwindcss.com/)
* **Database**: MySQL
* **Scripting**: JavaScript (Alpine.js / Vanilla JS)

## ⚙️ Installation & Setup

Follow these steps to deploy the project locally:

1.  **Clone the Repository**
    ```bash
    git clone <your-repo-url>
    cd LocateIT_2
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Environment Configuration**
    * Duplicate the example environment file:
    ```bash
    cp .env.example .env
    ```
    * Open the `.env` file and configure your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Database Migration**
    ```bash
    php artisan migrate
    ```

6.  **Compile Assets**
    ```bash
    npm run build
    ```

7.  **Launch the Server**
    ```bash
    php artisan serve
    ```

    Access the application at `http://127.0.0.1:8000`.

---
