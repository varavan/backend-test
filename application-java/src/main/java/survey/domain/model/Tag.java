package survey.domain.model;

public final class Tag {
	
	private String name;
	private String description;
	private String createdAt;
	
	public Tag(String name, String description, String createdAt){
		this.name = name;
		this.description = description;
		this.createdAt = createdAt;
	}
	
	public String getName(){
		return this.name;
	}
	
	public String getDescription(){
		return this.description;
	}
	
	public String CreatedAt(){
		return this.createdAt;
	}
}
