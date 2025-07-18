# LocalBridge 

LocalBridge is a civic issue reporting platform designed to bridge the gap between citizens and local authorities. It empowers users to report problems like potholes, sanitation issues, water leaks, and more — directly from the web.

##  Key Features

-  **Real-Time Issue Tracking** – Stay updated with live status and details.
-  **Report with Images** – Upload photos to highlight real problems.
-  **Vote on Issues** – Support or downvote issues to prioritize them.
-  **Comment System** – Engage in community discussions on each issue.
-  **Community-Powered** – Collective visibility and action.
-  **User Authentication** – Sign up and login functionality for secure issue reporting.
-  **Category & Status Filters** – Easily sort and find relevant issues.
-  **Search Bar** – Quickly find reports by title or keywords.

##  Built With

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Storage**: LocalStorage for votes and comments (client-side)

## How It Works

1. Users can submit issues with a title, category, description, and image.
2. Issues appear on a public dashboard with real-time filters and search.
3. Each issue can be viewed in detail, voted on, and commented on.
4. No login required for voting/commenting, but only signed-in users can report new issues.

## Folder Structure

- `index.html` – Landing Page
- `issues.html` – List of reported issues
- `issue_detail.php` – Detailed view of each issue
- `submit_issue.php` – PHP backend to submit issues
- `get_issues.php` – PHP backend to fetch issues
- `assets/` – Images, CSS, JS files

##  Future Enhancements

- Admin dashboard for issue moderation
- Email/SMS notifications
- Location-based filtering using maps
- Mobile app integration

