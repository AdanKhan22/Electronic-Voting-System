<nav>
    <div class="container">
        <a href="index.php?page=home" class="logo">Election System</a>
        <ul class="nav-links">
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=citizens">Citizens</a></li>
            <li><a href="index.php?page=voters">Voters</a></li>
            <li><a href="index.php?page=elections">Elections</a></li>
            <li><a href="index.php?page=results">Results</a></li>
            <form action="logout.php" method="POST">

                <button type="submit">Logout</button>
            </form>
            <form action="../src/citizendata.php" method="POST">
                <button type="submit">Profile</button>
            </form>
        </ul>
    </div>
</nav>