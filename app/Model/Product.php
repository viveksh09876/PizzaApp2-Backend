<?php

App::uses('AppModel', 'Model');

class Product extends AppModel {

    public $actsAs = array('Common');
    public $validate = array(
        'title' => array(
            'required' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter product title.'
            )
        ),
        'plu_code' => array(
            'required' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter product PLU code.'
            )
        ),
        'category_id' => array(
            'required' => array(
                'rule' => array('notempty'),
                'message' => 'Please select category.'
            )
        )
    );

    public function beforeSave($options = Array()) {
        $slug = $this->data['Product']['slug'];
        $name = $this->data['Product']['title'];
        $id = (!empty($this->data['Product']['id'])) ? $this->data['Product']['id'] : 0;
        $languageId = CakeSession::read('language.id');
        $this->data['Product']['lang_id'] = $languageId;

        $slug = (!empty($slug)) ? str_replace(' ', '-', strtolower($slug)) : str_replace(' ', '-', strtolower($name));

        $count = $this->isSlugExits($slug, $id);
        if ($count > 0) {
            $this->data['Product']['slug'] = $slug . '-' . $count;
        } else {
            $this->data['Product']['slug'] = $slug;
        }

        /// code for menu page dropdown 
        if (isset($this->data['Product']['dd_group_id']) && !empty($this->data['Product']['dd_group_id'])) {
            $dd_group_id = $this->data['Product']['dd_group_id'];
            if (isset($this->data['Product']['added'][$dd_group_id])) {
                $this->data['Product']['dd_default_selection'] = $this->data['Product']['added'][$dd_group_id]['default_option_id'][0];
            }
        }
        /// end code drop down
    }

    public function isSlugExits($slug, $id) {
        $count = $this->find('count', array('conditions' => array('Product.slug' => $slug, 'Product.id !=' => $id)));
        if ($count > 0) {
            return $this->find('count');
        } else {
            return $count;
        }
    }

    public function beforeFind($queryData) {
        if (CakeSession::check('language.id')) {
            $languageId = CakeSession::read('language.id');
            $queryData['conditions']['Product.lang_id'] = $languageId;
        }
        return $queryData;
    }

    public function getProducts($paginate, $conditions = array(), $limit = 10) {
        $categories = array();
        $qOpts = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'order' => 'Product.id DESC'
        );

        if ($paginate) {
            return $qOpts;
        } else {
            $data = $this->find('all', $qOpts);
            return $data;
        }
    }

    function addProduct($data) {
        $this->create();
        if ($this->save($data)) {
            return true;
        } else {
            return false;
        }
    }

    function updateProduct($data) {
        if ($this->save($data)) {
            return true;
        } else {
            return false;
        }
    }

}
