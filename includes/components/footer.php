<footer>
    <section>
        <div class="title">
            <p>02.</p>
            <h3>
                <?=$translations['contact']??'Contact'?>
            </h3>
        </div>
        <div class="content">
            <div class="contact">
                <div class="contact-link">
                    <h4>
                        Mon <strong>profil</strong> vous interesse ? <br>
                        <strong><a href="mailto:martin.lucas.celestin@gmail.com">Contactez-moi</a></strong> directement.
                    </h4>
                    <div class="arrow">
                        <a href="mailto:martin.lucas.celestin@gmail.com">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-arrow-up-right">
                                <path d="M7 7h10v10" />
                                <path d="M7 17 17 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="rs">
                    <div class="linkedin">
                        <a href="https://www.linkedin.com/in/martin-lucas-celestin/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                <rect width="4" height="12" x="2" y="9" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                        </a>
                    </div>
                    <div class="github">
                        <a href="https://github.com/Soltikz">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.403 5.403 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4" />
                                <path d="M9 18c-4.51 2-5-2-7-2" />
                            </svg>
                        </a>
                    </div>
                    <div class="codepan">
                        <a href="https://codepen.io/Soltikz">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polygon points="12 2 22 8.5 22 15.5 12 22 2 15.5 2 8.5 12 2" />
                                <line x1="12" x2="12" y1="22" y2="15.5" />
                                <polyline points="22 8.5 12 15.5 2 8.5" />
                                <polyline points="2 15.5 12 8.5 22 15.5" />
                                <line x1="12" x2="12" y1="2" y2="8.5" />
                            </svg>
                        </a>
                    </div>
                    <div class="instagram">
                        <a href="#">

                        </a>

                    </div>
                </div>
            </div>
            <div class="bottom">
                <div class="logo_footer">
                    <a href="index.php">
                        <svg width="63" height="54" viewBox="0 0 102 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 80V0H14.8444V66.9333H39.8222V80H0Z" fill="#FEFEFE" />
                            <path
                                d="M26.3099 62L26.3099 0L64.0877 46.7097L101.243 0V80H87.1099V54.3656C87.1099 51.8996 87.1395 49.147 87.1988 46.1075C87.2581 43.0107 87.5247 39.5125 87.9988 35.6129C86.1618 38.595 84.384 41.2043 82.6655 43.4409C80.9469 45.6774 79.3766 47.7419 77.9544 49.6344L63.821 68.3011L49.1544 49.6344C47.7321 47.8566 46.1025 45.7634 44.2655 43.3548C42.4877 40.8889 40.7099 38.2222 38.9321 35.3548C39.4062 39.4265 39.6729 42.9821 39.7321 46.0215C39.7914 49.0609 39.821 51.8423 39.821 54.3656V56L39.821 62H26.3099Z"
                                fill="#FEFEFE" />
                        </svg>
                    </a>
                </div>
                <p class="coppy">© Lucas Martin, 2024 - Design by Théo</p>
                <div class="backlink">
                    <a href="mentionlegal.php">Mention Légal</a>
                    <span>-</span>
                    <a href="site-plan.php">Plan du Site</a>
                    <span>-</span>
                    <?php if (isset($_SESSION['users'])): ?>
                    <a href="logout.php" class="logout">Déconnexion</a>
                    <?php else: ?>
                    <a href="login.php">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</footer>