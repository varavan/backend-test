package iruiz.survey.infrastructure.repository;

import java.util.ArrayList;
import java.util.Iterator;
import org.springframework.stereotype.Component;
import iruiz.survey.domain.model.Answer;
import iruiz.survey.domain.model.Question;
import iruiz.survey.domain.model.Survey;
import iruiz.survey.domain.repository.SurveyRepositoryInterface;
import iruiz.utils.Slugify;

@Component
public class MockSurveyRepository implements SurveyRepositoryInterface{

	@Override
	public ArrayList<Survey> findAll() {
		return this.getAllMockedData();
	}

	@Override
	public Survey findOneBySlug(String slug) {
		ArrayList<Survey> surveys = this.getAllMockedData();
		Survey survey = null;
		slug = Slugify.toSlug(slug);
		for(Iterator<Survey> i = surveys.iterator(); i.hasNext(); ){
			Survey surveyToCheck = i.next();
			if(surveyToCheck.getSlug().equals(slug)){
				survey = surveyToCheck;
			}
		}
		
		return survey;
	}
	
	private ArrayList<Survey> getAllMockedData(){
		ArrayList<Survey> surveys = new ArrayList<Survey>();
		
	     for (int rootCounter = 1; rootCounter <= 9; rootCounter++ ) {
	    	 Survey survey = new Survey("test survey " + rootCounter, "an description", "2014-06-01");
	    	 
	    	 for (int surveyIterator = 1; surveyIterator <= 4; surveyIterator++){
	    		 Question question = new Question("any question name", "any description name", "2014-06-01");
	    		 
	    		 for (int questionIterator = 1; surveyIterator <= 5; surveyIterator++){
	    			 String title = "10" + rootCounter + surveyIterator + questionIterator;
	    			 Answer answer = new Answer(title, "content", "2015-06-01");
		    		 question.addAnswer(answer);
		    		 survey.addQuestion(question);
		    	 }
	    		 
	    		 survey.addQuestion(question);
	    	 }
	    	 
	    	 surveys.add(survey);
	      }
	     
		return surveys;
		
	}
	
}
