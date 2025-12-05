# WhatsUpDoc 🩺

> **A High-Performance Medical Appointment Management System**
>
> *Engineered to demonstrate full-stack proficiency with a focus on Raw SQL, Database Normalization, and Modern React Design Patterns.*

---

## 🚀 Project Overview

WhatsUpDoc is an end-to-end healthcare platform designed to streamline the connection between patients and doctors. Unlike typical CRUD apps, this system handles complex scheduling logic, atomic booking transactions, and role-based access control, all wrapped in a premium, minimalist interface.

## 👨‍💻 Technical Proficiency Showcase

This project was built with specific design choices to demonstrate advanced technical skills:

### 1. Database Engineering & Raw SQL (No ORMs)
Instead of relying on ORMs like Sequelize or Prisma, this project utilizes **Raw SQL queries** for all database interactions.
- **Why?** To demonstrate a deep understanding of SQL syntax, optimization, and checking execution plans.
- **Key Features**:
  - Complex `JOIN` operations to aggregate doctor, slot, and user data efficiently.
  - **ACID Compliant Transactions**: Booking appointments uses MySQL transactions (`START TRANSACTION`, `COMMIT`, `ROLLBACK`) to prevent race conditions and double-bookings.
  - **Normalized Schema**: Database designed to 3NF to reduce redundancy and ensure data integrity.

### 2. Modern React Architecture
The frontend is built with **React 19** and **Vite**, prioritizing performance and code maintainability.
- **State Management**: Uses React Context API (`AuthContext`) for global state instead of heavy external libraries.
- **Custom Hooks**: Encapsulated logic for API communication and authentication.
- **Component Design**: reusable, atomic components (`Input`, `Button`) styled with Tailwind CSS utility classes for consistency.

### 3. System Architecture & DevOps
- **Dockerized Environment**: Fully containerized application using `docker-compose` for consistent development and deployment environments.
- **Middleware Integration**: Custom Express middleware for secure route handling and error management.
- **Scalable Structure**: Monorepo-style organization separating strictly typed concerns between `client` and `server`.

---

## 🛠 Tech Stack

| Domain | Technologies |
|--------|--------------|
| **Frontend** | React (Vite), Tailwind CSS v4, Axios, React Router 7 |
| **Backend** | Node.js, Express.js, MySQL2 (Driver) |
| **Database** | MySQL 8.0 |
| **DevOps** | Docker, Docker Compose |

---

## ✨ Core Features

- **🔐 Secure Authentication**: Role-based login/signup flows for Patients and Doctors.
- **📅 Smart Scheduling**: Doctors can publish availabilities; Patients can view and book them instantly.
- **� Atomic Bookings**: Prevents conflicting appointments using database-level locking mechanisms.
- **🎨 Premium UI**: A clean, "Linear-style" minimalist aesthetic design for professional usability.

---

## ⚡️ Getting Started

### Prerequisites
- Docker & Docker Compose
- Node.js (v18+)

### Installation

1. **Spin up the Backend & Database**
   This initializes the MySQL container with the custom schema and starts the API.
   ```bash
   docker-compose up -d --build
   ```

2. **Start the Frontend**
   Launch the React development server.
   ```bash
   cd client
   npm install
   npm run dev
   ```

3. **Access the App**
   - Frontend: `http://localhost:5173`
   - API: `http://localhost:3000`

---

## 🧪 Testing

1. **Patient Flow**: Create an account, browse doctors, and book an available slot.
2. **Doctor Flow**: Log in, view your dashboard, and publish new time slots.
3. **API verification**:
   ```bash
   # Check raw SQL query performance for doctor slots
   GET /doctors/:id/slots
   ```

---

*Created by [Your Name]*
