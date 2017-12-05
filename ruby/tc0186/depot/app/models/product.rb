class Product < ActiveRecord::Base
  has_many :line_items

  validates_presence_of :title, :description, :image_url
  validates_numericality_of :price
  validates_uniqueness_of :title
  validates_format_of	:image_url,
						:with		=> %r{\.(gif|jpg|png)$}i,
#						:message	=> nil
						:message	=> "must be a URL for a GIF, JPG, or PNG image"
  
  def self.find_products_for_sale
	find(:all, :order => "title")
  end
  
  protected
  def validate
    errors.add(:price, "should be at least 0.01") if price.nil? || price < 0.01
#	errors.add(:image_url, "Cannot be a zip file") if image_url == "foo.zip"
  end
end
