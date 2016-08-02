package iruiz.survey.domain.model;

import iruiz.utils.Slugify;

public final class Tag {
	
	private String name;
	private String slug;
	private String description;
	private String createdAt;
	
	public Tag(String name, String description, String createdAt){
		this.name = name;
		this.slug = Slugify.toSlug(name);
		this.description = description;
		this.createdAt = createdAt;
	}
	
	public String getName(){
		return this.name;
	}
	
	public String getSlug(){
		return this.slug;
	}
	
	public String getDescription(){
		return this.description;
	}
	
	public String getCreatedAt(){
		return this.createdAt;
	}
}
