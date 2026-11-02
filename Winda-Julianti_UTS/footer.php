  </main>
  <footer class="footer"><div class="container footer-inner"><a class="brand footer-brand" href="index.html">WJ<span>.</span></a><p>Dibuat dengan sederhana, untuk langkah yang lebih besar.</p><span>© <?= date('Y') ?> Winda Julianti</span></div></footer>
  <script>
    const toggle = document.querySelector('.menu-toggle');
    const links = document.querySelector('.nav-links');
    toggle.addEventListener('click', () => {
      const open = links.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open);
    });
  </script>
</body>
</html>
