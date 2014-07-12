            <?php if ($wp_query->max_num_pages > 1) get_template_part('templates/section', 'pagination'); ?>
            </div><!-- page-main__left -->
            <div class="page-main__right col-12-3 col-push-12-1">
                <?php get_template_part('templates/section', 'info'); ?>
            </div><!-- page-main__right -->
        </div><!-- grid -->
    </div><!-- page-main -->
    <footer class="page-footer">
        <?php get_template_part('templates/section', 'footer'); ?>
    </footer><!-- page-footer -->
    <?php wp_footer(); ?>
</body>
</html>
