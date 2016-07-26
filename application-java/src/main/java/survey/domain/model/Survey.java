package survey.domain.model;

public final class Survey {
	
	private String name;
	private String description;
	private String createdAt;
	
	public Survey(String name,String description, String createdAt ){
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
	
	public String getCreatedAt(){
		return this.createdAt;
	}
}
