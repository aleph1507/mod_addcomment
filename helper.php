<?php
/**
 * helper class for hello world module
 */
class ModAddCommentHelper
{

    public static function getAjax()
    {
        include_once JPATH_ROOT . '/components/com_content/helpers/route.php';

        $input = JFactory::getApplication()->input;
        $article_id = $input->getInt('id');
        $data  = $input->get('data', '', 'string');

        // Connect to database
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $columns = ['comment', 'article_id'];
        $values = [$db->quote($data), $article_id];

        $query
            ->insert($db->quoteName('#__comments'))
            ->columns($columns)
            ->values(implode(',', $values));

        $db->setQuery($query);

        return $db->execute();
    }

    public static function getComments($params)
    {
        $article_id = JFactory::getApplication()->input->getInt('id');

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select($db->quoteName('comment'))
            ->from($db->quoteName('#__comments'))
            ->where('article_id = '. $db->quote($article_id))
            ->order('id DESC');
//        // Prepare the query
        $db->setQuery($query);
//        // Load the row.
        $result = $db->loadAssocList();
        return json_encode($result);

    }

}