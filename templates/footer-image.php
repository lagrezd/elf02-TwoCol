            <?php if ($wp_query->max_num_pages > 1) get_template_part('templates/section', 'pagination'); ?>
            </div>
        </div>
    </main>
    <footer class="page-footer">
        <?php get_template_part('templates/section', 'footer'); ?>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
