<?php

return [
    'title' => 'डैशबोर्ड',
    'grid' => [
        'char-list' => 'खिलाड़ियों की सूची',
        'char-list-desc' => 'यहां आप अपने खुद के खिलाड़ियों को अतिरिक्त जानकारी के साथ देख सकते हैं।',
        'settings' => 'सेटिंग्स',
        'settings-desc' => 'सेटिंग्स में आप अपने पासवर्ड, ई-मेल और अन्य परिवर्तन बदल सकते हैं। अगर आप कुछ याद करते हैं, तो हमें बताएं।',
        'donation' => 'दान',
        'donation-desc' => 'इस चीज़ के तहत आप कुछ अच्छा कर सकते हैं और हमारा समर्थन कर सकते हैं! धन्यवाद के रूप में आपको खेल में :silk मिलेगा।',
        'other' => 'विविध',
        'other-desc' => 'सब कुछ जो अभी तक बिल्कुल नहीं रखा गया है, इस बिंदु के तहत पाया जा सकता है।',
        'ref' => 'रेफरल',
        'ref-desc' => 'यह देखने के लिए कि आपने पहले से किसे आमंत्रित किया है और आपने कितना कमाया है, यहाँ क्लिक करें।',
        'tickets' => 'टिकट',
        'tickets-desc' => 'आपको कोई समस्या या अनुरोध है? यहां आप टिकट बना सकते हैं और हम इसका ध्यान रखेंगे।',
        'voucher' => 'वाउचर',
        'voucher-desc' => 'आपके पास एक क्रेडिट नोट है और इसे :silk के लिए भुनाना चाहते हैं? तब आप इसे भुना सकते हैं',
        'web-inventory' => 'वेब इन्वेंटरी',
        'web-inventory-help' => 'यहां आप अपनी "इन्वेंट्री" पा सकते हैं जहां आपके खरीदे या बेचे गए आइटम हैं।',
    ],

    'chars-list' => [
        'title' => 'खिलाड़ी सूची',
        'no-chars' => 'कृपया आगे के कार्यों के लिए एक चरित्र बनाएँ।',
        'last-logout' => 'अंतिम लॉगआउट:',
        'level' => 'स्तर:',
        'gold' => 'सोना:',
        'guild' => 'समाज:',
        'logged-in' => 'लॉग इन किया',
        'logged-out' => 'लॉग आउट किया',
    ],
    'donations' => [
        'title' => 'दान',
        'text' => 'आप कई प्रदाताओं में से एक को चुन सकते हैं जहाँ आप पैसे दान कर सकते हैं। बदले में आपको हमारे सर्वर पर सिक्का ' . config('siteSettings.sro_silk_name', 'Silk') . ' मिलता है।',
        'no_methods' => 'कोई विधियाँ नहीं मिलीं, व्यवस्थापक ने एक भी सक्रिय नहीं किया।',
    ],
    'settings' => [
        'title' => 'समायोजन',
        'form' => [
            'name' => 'नाम',
            'email' => 'ईमेल',
            'map' => 'दुनिया का नक्शा',
            'referral' => 'निर्दिष्ट संबंध',
            'show-map' => 'मानचित्र पर अपने खाते दिखाएं',
            'silkroad-password' => 'नया सिल्करोड पासवर्ड',
            'silkroad-password-confirmation' => 'सिल्करोड पासवर्ड की पुष्टि करें',
            'web-password' => 'नया वेब पासवर्ड',
            'web-password-confirmation' => 'वेब पासवर्ड की पुष्टि करें',
            'current-web-password' => 'वर्तमान वेब पासवर्ड',
            'current-web-password-help' => 'किसी भी डेटा को बदलने के लिए आपको इसे भरना होगा!',
            'submit' => 'सेटिंग्स सहेजें',
            'wrong-current-web-password' => 'दर्ज किया गया पासवर्ड गलत है',
            'successfully' => 'आपने अपना डेटा सफलतापूर्वक बदल दिया है।',
        ],
    ],
    'ref' => [
        'title' => 'रेफरल',
        'signature' => 'हस्ताक्षर',
        'no-signature' => 'वर्तमान में कोई हस्ताक्षर नहीं है।',
        'your-ref' => 'आपका रेफरल',
        'table' => [
            'name' => 'खाते का नाम',
            'date' => 'तारीख',
        ],
    ],
    'voucher' => [
        'title' => 'वाउचर के एवज',
        'table' => [
            'voucher' => 'वाउचर',
            'amount' => 'धनराशि',
            'used-at' => 'पर इस्तेमाल किया गया',
        ],
        'form' => [
            'voucher' => 'वाउचर',
            'voucher-help' => 'यहां आप अपने क्रेडिट कोड को भुना सकते हैं',
            'submit' => 'इसे भुनाओ'
        ],
    ],

    'tickets' => [
        'title' => 'टिकट',
        'create-new' => 'नया टिकट',
        'table' => [
            'title' => 'शीर्षक',
            'state' => 'स्थिति',
            'priority' => 'प्राथमिकता',
            'updated-at' => 'संशोधित किया गया',
            'action' => 'कार्य'
        ],
        'new' => [
            'title' => 'नया टिकट',
            'form' => [
                'title' => 'शीर्षक',
                'category' => 'वर्ग',
                'no-categories' => 'वर्तमान में अभी तक कोई श्रेणियां नहीं हैं',
                'priority' => 'प्राथमिकता',
                'no-priorities' => 'वर्तमान में अभी तक कोई प्राथमिकता नहीं है',
                'body' => 'विषय',
                'body-placeholder' => 'यहां आप अपने अनुरोध का वर्णन कर सकते हैं',
                'submit' => 'टिकट बनाएं',
                'successfully' => 'आपने सफलतापूर्वक एक टिकट बनाया है।',
            ],
        ],
        'show' => [
            'title' => 'टिकट दिखाया गया है',
            'form' => [
                'title' => 'शीर्षक:',
                'category' => 'वर्ग:',
                'priority' => 'प्राथमिकता:',
                'state' => 'स्थिति:',
                'reply' => 'उत्तर पाठ',
                'reply-placeholder' => 'यहां आप अपना उत्तर लिख सकते हैं',
                'submit' => 'टिकट का जवाब दें',
                'submit-close' => 'टिकट बंद!',
                'closed-state' => 'जवाब देते समय आप टिकट को दोबारा खोलते हैं',
                'wrong-owner' => 'कुछ सही नहीं है, ऐसा लगता है कि आप टिकट धारक नहीं हैं।',
                'successfully' => 'आपने इस टिकट का सफलतापूर्वक उत्तर दिया है।',
            ],
        ],
    ],
];
