<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Project Credits</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        background: #0a0a0a;
        color: #fff;
        height: 100vh;
        overflow: hidden;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Star background */
    .star {
        position: absolute;
        width: 2px;
        height: 2px;
        background: white;
        border-radius: 50%;
        opacity: 0.8;
        animation: twinkle 2s infinite alternate;
    }
    @keyframes twinkle {
        0% { opacity: 0.2; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.5); }
        100% { opacity: 0.2; transform: scale(1); }
    }

    /* Credits container */
    .credits-container {
        position: relative;
        width: 100%;
        max-width: 550px;
        height: 85%;
        overflow: hidden;
        text-align: center;
        border-radius: 20px;
        background: rgba(28,28,30,0.85);
        padding: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.7);
    }

    .credits {
        display: flex;
        flex-direction: column;
        gap: 25px;
        position: absolute;
        bottom: -100%;
        width: 100%;
        animation: scrollUp 60s linear infinite;
    }

    @keyframes scrollUp {
        0% { bottom: -100%; }
        100% { bottom: 100%; }
    }

    h1 {
        margin-bottom: 20px;
        font-size: 28px;
        color: #00c6ff;
    }

    .member {
        font-size: 16px;
        color: #fff;
        line-height: 1.5;
        text-align: left;
    }

    .role {
        font-size: 14px;
        color: #ccc;
        display: block;
        margin-top: 3px;
        text-align: left;
    }
</style>
</head>
<body>

<div class="credits-container">
    <h1>Group 2 - Project Team</h1>
    <div class="credits">
        <div class="member">OWUSU Emmanuel 
            <span class="role">
            UEB3215222 - Group Leader | Main Developer & Project Coordinator.
            Handled PHP session management, dashboard creation, and CRUD functionality using PDO prepared statements.
            Example: <code>$stmt = $pdo->prepare("INSERT INTO tasks ...");</code>
            </span>
        </div>

        <div class="member">OWUSU Felix Pipim 
            <span class="role">
            UEB3212422 - Frontend Developer & UI Designer.
            Built responsive layouts using CSS Flexbox and styled interactive buttons. Implemented animated star background using JS.
            Example: <code>document.createElement('div');</code>
            </span>
        </div>

        <div class="member">ADDO-BAFFOE Prince 
            <span class="role">
            UEB3204422 - Backend Developer & Database Management.
            Created MySQL database, connected via PDO, wrote secure queries, and implemented student-specific task retrieval.
            Example: <code>$stmt = $pdo->prepare("SELECT * FROM tasks WHERE student_id = ?");</code>
            </span>
        </div>

        <div class="member">OWUSU Cosmos Siaw 
            <span class="role">
            UEB3210722 - Testing & Bug Fixing.
            Conducted testing for task creation, deletion, hover effects, and responsive layout fixes.
            Verified confirmation dialogues and resolved CSS overlapping issues.
            </span>
        </div>

        <div class="member">OCRAN Tei Clifford 
            <span class="role">
            UEB3200622 - Task Scheduling & Logic Implementation.
            Developed task ordering logic, status toggle system, and scrolling credits animation with CSS keyframes.
            </span>
        </div>

        <div class="member">BOAKYE Albert 
            <span class="role">
            UEB3213222 - Documentation & Version Control.
            Maintained Git repository, wrote project documentation, and prepared flowcharts for project understanding.
            </span>
        </div>

        <div class="member">ANANE Benedicta Ohenewaa (ms) 
            <span class="role">
            UEB3204122 - UI Enhancement & Styling.
            Improved readability of task cards, added padding, margins, hover animations, and credits page styling.
            </span>
        </div>

        <div class="member">MUSTAPHA Sharifa (ms) 
            <span class="role">
            UEB3204222 - Testing & User Feedback.
            Tested form validation, user interaction, and mobile responsiveness. Suggested improvements for UI and readability.
            </span>
        </div>

        <div class="member">NTORI Elijah 
            <span class="role">
            UEB3210622 - Database Integration & Security.
            Implemented login authentication with password hashing and ensured secure user session management.
            Example: <code>password_verify($inputPassword, $user['password_hash']);</code>
            </span>
        </div>

        <div class="member">ESSUAH Caleb 
            <span class="role">
            UEB3212522 - Code Review & Deployment.
            Reviewed PHP, JS, CSS code, deployed project on XAMPP/WAMP, and verified functionality of delete button, scrolling credits, and animations.
            </span>
        </div>
    </div>
</div>

<script>
    // Generate stars in the background
    const numStars = 120;
    for (let i = 0; i < numStars; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        star.style.top = Math.random() * window.innerHeight + 'px';
        star.style.left = Math.random() * window.innerWidth + 'px';
        star.style.width = Math.random() * 3 + 1 + 'px';
        star.style.height = star.style.width;
        star.style.animationDuration = (Math.random() * 2 + 1) + 's';
        document.body.appendChild(star);
    }
</script>
</body>
</html>
