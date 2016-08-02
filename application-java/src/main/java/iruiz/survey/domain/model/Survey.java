package iruiz.survey.domain.model;

import java.util.ArrayList;

import iruiz.utils.Slugify;

public final class Survey {
	
	private String name;
	private String slug;
	private String description;
	private String createdAt;
	private ArrayList<Question> questions;
	private ArrayList<Tag> tags;
	
	public Survey(String name,String description, String createdAt ){
		this.name = name;
		this.slug = Slugify.toSlug(name);
		this.description = description;
		this.createdAt = createdAt;
		this.questions = new ArrayList<Question>();
		this.tags = new ArrayList<Tag>();
	}
	
	public void addTag(Tag tag){
		this.tags.add(tag);
	}
	
	public ArrayList<Tag> getTags(){
		return this.tags;
	}
	
	public void addQuestion(Question question){
		this.questions.add(question);
	}
	
	public ArrayList<Question> getQuestions(){
		return this.questions;
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
