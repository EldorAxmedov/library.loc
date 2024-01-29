<?php
namespace common\models;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use yii\imagine\Image;
use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string|null $isbn
 * @property int $knowledge_id
 * @property int $subject_id
 * @property string|null $udk
 * @property string|null $bbk
 * @property string $name
 * @property string|null $another_name
 * @property string[]|int[] book_author_join
 * @property int $country_id
 * @property string $region
 * @property string $publisher
 * @property int $year_id
 * @property int $page
 * @property int|null $exemplary
 * @property int $language_id
 * @property int $type_id
 * @property string|null $annotation
 * @property string[]|int[] book_tag_join
 * @property string $inventory_number
 * @property float $price
 * @property int $count
 * @property int $location_id
 * @property int $created_at
 * @property int|null $updated_at
 
 * @property BookAuthor[] $bookAuthors
 * @property BookTag[] $bookTags
 * @property Country $country
 * @property Knowledge $knowledge
 * @property Subject $subject
 * @property LanguageBook $language
 * @property Location $location
 * @property TypeBook $type
 */
class Books extends \yii\db\ActiveRecord
{

   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

      
    
    public $book_author_join;
    public $book_tag_join;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['knowledge_id', 'subject_id', 'name', 'book_author_join', 'country_id', 'region', 'publisher', 'year_id', 'page', 'language_id', 'type_id', 'book_tag_join', 'inventory_number', 'price', 'count', 'location_id'], 'required'],
            [['knowledge_id', 'subject_id', 'country_id', 'year_id', 'page', 'exemplary', 'language_id', 'type_id', 'count', 'location_id', 'created_at', 'updated_at'], 'integer'],
            [['annotation'], 'string'],
            [['price'], 'number'],
            [['isbn', 'udk', 'bbk', 'name', 'another_name', 'inventory_number', 'region', 'publisher'], 'string', 'max' => 255],
            [['knowledge_id'], 'exist', 'skipOnError' => true, 'targetClass' => Knowledge::class, 'targetAttribute' => ['knowledge_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::class, 'targetAttribute' => ['subject_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::class, 'targetAttribute' => ['country_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => LanguageBook::class, 'targetAttribute' => ['language_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeBook::class, 'targetAttribute' => ['type_id' => 'id']],
            [['book_author_join', 'book_tag_join', 'img'], 'safe'],
            [['img'], 'file', 'skipOnError' => true, 'extensions' => 'jpg, png, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'isbn' => 'ISBN',
            'knowledge_id' => 'Bilimlar sohasi',
            'subject_id' => 'Fanlar',
            'udk' => 'UDK',
            'bbk' => 'BBK',
            'name' => 'Kitob nomi',
            'another_name' => 'Boshqa nomi',
            'book_author_join' => 'Mualliflar',
            'country_id' => 'Mamlakat',
            'region' => 'Viloyat',
            'publisher' => 'Nashriyot',
            'year_id' => 'Nashr qilingan yili',
            'page' => 'Sahifalar soni',
            'exemplary' => 'Adadi',
            'language_id' => 'Kitob tili',
            'type_id' => 'Kitob turi',
            'annotation' => 'Annotatsiya',
            'book_tag_join' => 'Kalit so\'zlar',
            'inventory_number' => 'Inventar raqami',
            'price' => 'Narxi',
            'count' => 'Kitob soni',
            'location_id' => 'Joylashgan joyi',
            'img' => 'Kitob rasmi',
            'created_at' => 'Yaratilgan vaqti',
            'updated_at' => 'Tahrirlangan vaqti',
        ];
    }


    public function upload()
    {
        if ($this->img instanceof \yii\web\UploadedFile && $this->validate()) {
            $this->img->saveAs(Yii::getAlias('@frontend') . '/web/uploads/books/' . time() . '.' . $this->img->extension);
            $new_path = Yii::getAlias('@frontend') . '/web/uploads/books/crop/' . time() . '.' . $this->img->extension;
            $imagine = new \yii\imagine\Image;
            $imagine->thumbnail(Yii::getAlias('@frontend') . '/web/uploads/books/' . time() . '.' . $this->img->extension, 250, 300)->save($new_path, ['quality' => 90]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets query for [[Knowledge]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getKnowledge()
    {
        return $this->hasOne(Knowledge::class, ['id' => 'knowledge_id']);
    }

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getSubject()
    {
        return $this->hasOne(Subject::class, ['id' => 'subject_id']);
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable('book_author', ['book_id' => 'id']);
    }

     /**
     * Gets query for [[BookTags]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('book_tag', ['book_id' => 'id']);
    }


    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(LanguageBook::class, ['id' => 'language_id']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::class, ['id' => 'location_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypeBook::class, ['id' => 'type_id']);
    }

    public function getInventoryCount()
    {
        return $this->hasMany(BookInventory::class, ['book_id' => 'id'])->count();
    }
}
