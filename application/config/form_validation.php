<?php
$config = array(
  // ユーザー新規登録用バリデーション
  'user_register' => array(
    array(
      'field' => 'email',
      'label' => 'メールアドレス',
      'rules' => 'trim|required|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]|max_length[255]|is_unique[user_data.mail]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'regex_match' => "{field}は正しい形式で入力してください。",
        'max_length' => "{field}は255文字以下で入力してください。",
        'is_unique' => "入力した{field}は既に登録されています。"
      )
    ),
    array(
      'field' => 'password1',
      'label' => 'パスワード',
      'rules' => 'trim|required|regex_match[/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,20}$/i]|matches[password2]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'regex_match' => "{field}は5文字以上20文字以下の半角数字、半角英字を含む値を入力してください。",
        'matches' => '{field}とパスワード【確認用】が一致しません。',
      )
    ),
    array(
      'field' => 'password2',
      'label' => 'パスワード【確認用】',
      'rules' => 'required',
      'errors' => array(
        'required' => '{field}が未入力です',
      )
    ),
  ),

  // パスワード再設定用バリデーション
  'password_reissue' => array(
    array(
      'field' => 'password1',
      'label' => '新しいパスワード',
      'rules' => 'trim|required|regex_match[/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{5,20}$/i]|matches[password2]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'regex_match' => "{field}は5文字以上20文字以下の半角数字、半角英字を含む値を入力してください。",
        'matches' => '{field}とパスワード【確認用】が一致しません。',
      )
    ),
    array(
      'field' => 'password2',
      'label' => '新しいパスワード【確認用】',
      'rules' => 'required',
      'errors' => array(
        'required' => '{field}が未入力です',
      )
    ),
  ),

  // マイページ入力フォーム
  'mypage' => array(
    array(
      'field' => 'name',
      'label' => 'ユーザー名',
      'rules' => 'trim|required|max_length[255]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'max_length' => "{field}は255文字以下で入力してください。",
      )
    ),
    array(
      'field' => 'kana',
      'label' => 'ユーザー名(カナ)',
      'rules' => 'trim|max_length[255]',
      'errors' => array(
        'max_length' => "{field}は255文字以下で入力してください。",
      )
    ),
    array(
      'field' => 'mail',
      'label' => 'メールアドレス',
      'rules' => 'required|trim|max_length[255]|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'max_length' => "{field}は255文字以下で入力してください。",
        'regex_match' => "{field}は正しい形式で入力してください。",
      )
    ),
    array(
      'field' => 'post',
      'label' => '郵便番号',
      'rules' =>  'required|trim|numeric|regex_match[/^\d{7}$/]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は7桁の半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'prefecture',
      'label' => '都道府県',
      'rules' =>  'required',
      'errors' => array(
        'required' => '{field}が未入力です',
      )
    ),
    array(
      'field' => 'address1',
      'label' => '住所1',
      'rules' =>  'required|trim',
      'errors' => array(
        'required' => '{field}が未入力です',
      )
    ),
    array(
      'field' => 'address2',
      'label' => '住所2',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'tel',
      'label' => '電話番号',
      'rules' =>  'required|trim|numeric|regex_match[/^0\d{9,10}$/]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'fax',
      'label' => 'FAX番号',
      'rules' =>  'trim|numeric|regex_match[/^0\d{9,10}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'bank_name',
      'label' => '振込先金融機関',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'bank_account',
      'label' => '振込先口座番号',
      'rules' =>  'trim|numeric',
      array(
        'numeric' => "%sは半角数字で入力してください",
      )
    ),
  ),

  // 顧客編集フォーム
  'customer_edit' => array(
    array(
      'field' => 'name',
      'label' => 'お客様名',
      'rules' => 'trim|required|max_length[255]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'max_length' => "{field}は255文字以下で入力してください。",
      )
    ),
    array(
      'field' => 'kana',
      'label' => 'お客様名(カナ)',
      'rules' => 'trim|max_length[255]',
      'errors' => array(
        'max_length' => "{field}は255文字以下で入力してください。",
      )
    ),
    array(
      'field' => 'mail',
      'label' => 'メールアドレス',
      'rules' => 'trim|max_length[255]|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]',
      'errors' => array(
        'max_length' => "{field}は255文字以下で入力してください。",
        'regex_match' => "{field}は正しい形式で入力してください。",
      )
    ),
    array(
      'field' => 'post',
      'label' => '郵便番号',
      'rules' =>  'trim|numeric|regex_match[/^\d{7}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は7桁の半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'address1',
      'label' => '住所1',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'address2',
      'label' => '住所2',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'tel',
      'label' => '電話番号',
      'rules' =>  'trim|numeric|regex_match[/^0\d{9,10}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'fax',
      'label' => 'FAX番号',
      'rules' =>  'trim|numeric|regex_match[/^0\d{9,10}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'customer_group',
      'label' => '部門',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'position',
      'label' => '役職',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'person',
      'label' => '担当者名',
      'rules' =>  'trim',
    ),
  ),

  // 顧客新規登録フォーム
  'customer_register' => array(
    array(
      'field' => 'name',
      'label' => 'お客様名',
      'rules' => 'trim|required|max_length[255]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'max_length' => "{field}は255文字以下で入力してください。",
      )
    ),
    array(
      'field' => 'kana',
      'label' => 'お客様名(カナ)',
      'rules' => 'trim|max_length[255]',
      'errors' => array(
        'max_length' => "{field}は255文字以下で入力してください。",
      )
    ),
    array(
      'field' => 'mail',
      'label' => 'メールアドレス',
      'rules' => 'trim|max_length[255]|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]',
      'errors' => array(
        'max_length' => "{field}は255文字以下で入力してください。",
        'regex_match' => "{field}は正しい形式で入力してください。",
      )
    ),
    array(
      'field' => 'post',
      'label' => '郵便番号',
      'rules' =>  'trim|numeric|regex_match[/^\d{7}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は7桁の半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'address1',
      'label' => '住所1',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'address2',
      'label' => '住所2',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'tel',
      'label' => '電話番号',
      'rules' =>  'trim|numeric|regex_match[/^0\d{9,10}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'fax',
      'label' => 'FAX番号',
      'rules' =>  'trim|numeric|regex_match[/^0\d{9,10}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'customer_group',
      'label' => '部門',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'position',
      'label' => '役職',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'person',
      'label' => '担当者名',
      'rules' =>  'trim',
    ),
  ),

  // 管理者画面 ユーザー新規登録
  'admin_register' => array(
    array(
      'field' => 'name',
      'label' => 'ユーザー名',
      'rules' => 'trim|required|max_length[255]',
      'errors' => array(
        'required' => '{field}が未入力です',
        'max_length' => "{field}は255文字以下で入力してください。",
      )
    ),
    array(
      'field' => 'kana',
      'label' => 'ユーザー名(カナ)',
      'rules' => 'trim|max_length[255]',
      'errors' => array(
        'max_length' => "{field}は255文字以下で入力してください。",
      )
    ),
    array(
      'field' => 'mail',
      'label' => 'メールアドレス',
      'rules' => 'trim|max_length[255]|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]',
      'errors' => array(
        'max_length' => "{field}は255文字以下で入力してください。",
        'regex_match' => "{field}は正しい形式で入力してください。",
      )
    ),
    array(
      'field' => 'post',
      'label' => '郵便番号',
      'rules' =>  'trim|numeric|regex_match[/^\d{7}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は7桁の半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'address1',
      'label' => '住所1',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'address2',
      'label' => '住所2',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'tel',
      'label' => '電話番号',
      'rules' =>  'trim|numeric|regex_match[/^0\d{9,10}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'fax',
      'label' => 'FAX番号',
      'rules' =>  'trim|numeric|regex_match[/^0\d{9,10}$/]',
      'errors' => array(
        'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
        'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
      )
    ),
    array(
      'field' => 'bank_name',
      'label' => '振込先金融機関',
      'rules' =>  'trim',
    ),
    array(
      'field' => 'bank_account',
      'label' => '振込先口座番号',
      'rules' =>  'trim|numeric',
      array(
        'numeric' => "%sは半角数字で入力してください",
      )
    ),
  ),

    // 管理者画面 ユーザー編集
    'admin_edit' => array(
      array(
        'field' => 'name',
        'label' => 'ユーザー名',
        'rules' => 'trim|required|max_length[255]',
        'errors' => array(
          'required' => '{field}が未入力です',
          'max_length' => "{field}は255文字以下で入力してください。",
        )
      ),
      array(
        'field' => 'kana',
        'label' => 'ユーザー名(カナ)',
        'rules' => 'trim|max_length[255]',
        'errors' => array(
          'max_length' => "{field}は255文字以下で入力してください。",
        )
      ),
      array(
        'field' => 'mail',
        'label' => 'メールアドレス',
        'rules' => 'trim|max_length[255]|regex_match[/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/]',
        'errors' => array(
          'max_length' => "{field}は255文字以下で入力してください。",
          'regex_match' => "{field}は正しい形式で入力してください。",
        )
      ),
      array(
        'field' => 'post',
        'label' => '郵便番号',
        'rules' =>  'trim|numeric|regex_match[/^\d{7}$/]',
        'errors' => array(
          'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
          'regex_match' => "{field}は7桁の半角数字・ハイフンなしで入力してください。",
        )
      ),
      array(
        'field' => 'address1',
        'label' => '住所1',
        'rules' =>  'trim',
      ),
      array(
        'field' => 'address2',
        'label' => '住所2',
        'rules' =>  'trim',
      ),
      array(
        'field' => 'tel',
        'label' => '電話番号',
        'rules' =>  'trim|numeric|regex_match[/^0\d{9,10}$/]',
        'errors' => array(
          'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
          'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
        )
      ),
      array(
        'field' => 'fax',
        'label' => 'FAX番号',
        'rules' =>  'trim|numeric|regex_match[/^0\d{9,10}$/]',
        'errors' => array(
          'numeric' => "{field}は半角数字・ハイフンなしで入力してください。",
          'regex_match' => "{field}は半角数字・ハイフンなしで入力してください。",
        )
      ),
      array(
        'field' => 'bank_name',
        'label' => '振込先金融機関',
        'rules' =>  'trim',
      ),
      array(
        'field' => 'bank_account',
        'label' => '振込先口座番号',
        'rules' =>  'trim|numeric',
        array(
          'numeric' => "%sは半角数字で入力してください",
        )
      ),
    ),
);
