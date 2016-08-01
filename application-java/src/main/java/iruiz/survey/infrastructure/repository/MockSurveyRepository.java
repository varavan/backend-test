package iruiz.survey.infrastructure.repository;

import java.util.ArrayList;
import java.util.Iterator;

import org.springframework.stereotype.Component;

import iruiz.app.dto.SurveyDto;
import iruiz.survey.domain.model.Answer;
import iruiz.survey.domain.model.Question;
import iruiz.survey.domain.model.Survey;
import iruiz.survey.domain.repository.SurveyRepositoryInterface;

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
		
		for(Iterator<Survey> i = surveys.iterator(); i.hasNext(); ){
			Survey surveyToCheck = i.next();
			if(survey.getSlug() == slug){
				survey = surveyToCheck;
			}
		}
		
		return survey;
	}
	
	private ArrayList<Survey> getAllMockedData(){
		ArrayList<Survey> surveys = null;
		
		int factor = 0;
	     while ( factor <= 9 ) {
	    	 Survey survey = new Survey("test survey " + factor, "an description", "2014-06-01");
	    	 
	    	 for (int surveyIterator = 1; surveyIterator <= 4; surveyIterator++){
	    		 Question question = new Question("any question name", "any description name", "2014-06-01");
	    		 
	    		 for (int questionIterator = 1; surveyIterator <= 5; surveyIterator++){
		    		 question.addAnswer(new Answer("10" + factor + surveyIterator + questionIterator, "content", "2015-06-01"));
		    		 survey.addQuestion(question);
		    	 }
	    		 
	    		 survey.addQuestion(question);
	    	 }
	    	 
	    	 surveys.add(survey);
	    	 
	         factor++;
	      }
		
		return surveys;
		
	}
	
}
