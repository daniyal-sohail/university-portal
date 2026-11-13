# DevXcript Student Portal Frontend

This project is a static frontend for a student portal website. It contains the user interface screens for a university or college portal, styled with a modern dashboard look and built mainly with HTML, CSS, and JavaScript.

## What is included in the frontend

### Authentication pages
- `signin.html` – login screen for students
- `forgot-password.html` – password recovery screen

### Student dashboard and portal sections
- `dashboard.html` – main student dashboard with profile summary, stats, and notifications
- `courses.html` – list of enrolled courses
- `course-detail.html` – detailed view of a selected course with progress and marks
- `results.html` – academic results and grade information
- `datesheet.html` – exam schedule / date sheet
- `invoices.html` – financial records and fee information
- `attendance.html` – attendance tracking page

## Frontend technologies

- HTML5 for page structure
- CSS for design, layout, colors, spacing, and responsive behavior
- JavaScript for simple interactivity such as:
  - sidebar open/close
  - password show/hide toggle
  - form validation
  - search and filtering for results, tables, and course cards
- Bootstrap for layout and UI components
- Bootstrap Icons and Google Fonts for styling

## Styling and structure

The custom styling is in:
- `css/style.css`

This file defines the color palette, card layouts, sidebar navigation, dashboard tiles, buttons, forms, tables, and responsive design.

## Scripts and behavior

The main front-end logic is in:
- `js/main.js`

This script handles:
- mobile menu behavior
- login validation
- forgot-password form flow
- filtering of course and table data
- dynamic date display

## Static assets

- `img/logo.png` – branding/logo used across the portal

## How to run it

Since this is a frontend-only project, you can open the HTML files directly in a browser.

For a local web server, run:

```bash
python -m http.server 8000
```

Then open:

```text
http://localhost:8000/signin.html
```

## Notes

This is a mock frontend and does not connect to a real backend, database, or authentication system. The content is mostly static demo data meant to represent a student portal UI.
