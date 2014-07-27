            <?php if ($wp_query->max_num_pages > 1) get_template_part('templates/section', 'pagination'); ?>
            </div><!--
         --><div class="page-main__right col-12-3 col-push-12-1">
                <?php get_template_part('templates/section', 'info'); ?>
            </div>
        </div>
    </div>
    <footer class="page-footer">
        <?php get_template_part('templates/section', 'footer'); ?>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
